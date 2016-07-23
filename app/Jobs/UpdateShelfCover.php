<?php

namespace App\Jobs;

use App\Shelf;
use Hash;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManager;
use Log;
use Storage;

class UpdateShelfCover extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $shelf;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Shelf $shelf)
    {
        $this->shelf = $shelf;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ImageManager $imageManager)
    {
        $books = $this->shelf->books()->whereNotNull('image')
            ->orderBy('created_at', 'desc')->take(1)->get()->toArray();
        $covers = [];
        foreach ($books as $book) {
            $covers[] = $book['image'];
        }

        if(empty($covers)) return;

        $s3 = Storage::disk('s3');
        // create a new image directly from an url
        // TODO: What if the book does not have a cover? It's empty.
        $img = $imageManager->make($covers[0]);
        // paste another image
        $img->blur(10);
        $path = Hash::make($this->shelf->id) . '.png';
        Log::info('Showing the path of the file: '. $path);

        $s3->put($path, (string)$img->fit(300)->encode());

        // save the cover url in db
        $this->shelf->forceFill([
            'cover' => $s3->url($path),
        ])->save();

        // delete the job
        $this->delete();

    }
}
