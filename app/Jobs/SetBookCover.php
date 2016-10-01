<?php

namespace App\Jobs;

use App\Book;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManager;
use Log;
use Storage;

class SetBookCover extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $book;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ImageManager $imageManager)
    {
        // If book does not have an image on Google then ignore.
        if (is_null($this->book->image)) {
            return $this->delete();
        }
        $s3 = Storage::disk('s3');
        // create a new image directly from an url
        $img = $imageManager->make((string)$this->book->image);
        // TODO: Instead of saving the image, first try to query to google and get the
        // large cover pic of this image.

        $path = 'book-covers/' . $this->book->google_volume_id . '.png';
        Log::info('Going to save the book image here at this path: '. $path);

        $s3->put($path, (string)$img->encode());
        $this->book->forceFill([
            'image' => $s3->url($path),
        ])->save();

        $this->delete();
    }
}
