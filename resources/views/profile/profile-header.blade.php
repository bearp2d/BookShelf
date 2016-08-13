<app-profile-header inline-template>
    <div class="profile-header p-t-lg">
        <div class="container max-width-1000">
            <div class="container-inner ">
                <img class="img-circle media-object" src="{{ $user->avatar }}">
                <h3 class="profile-header-user">{{ $user->name }}</h3>
                <p class="profile-header-bio">
                    {{ $user->about }}
                </p>
            </div>
            <!-- Sharingbutton Facebook -->
            <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=https%3A%2F%2Fbooknshelf.com%2F" target="_blank" aria-label="Facebook">
              <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--medium"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                <svg version="1.1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                    <g>
                        <path d="M18.768,7.465H14.5V5.56c0-0.896,0.594-1.105,1.012-1.105s2.988,0,2.988,0V0.513L14.171,0.5C10.244,0.5,9.5,3.438,9.5,5.32 v2.145h-3v4h3c0,5.212,0,12,0,12h5c0,0,0-6.85,0-12h3.851L18.768,7.465z"/>
                    </g>
                </svg></div>Facebook</div>
            </a>

            <!-- Sharingbutton Twitter -->
            <a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text=Check%20out%20my%20bookshelves%20on%20Booknshelf&amp;url=https%3A%2F%2Fbooknshelf.com%2F" target="_blank" aria-label="Twitter">
              <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--medium"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                <svg version="1.1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                    <g>
                        <path d="M23.444,4.834c-0.814,0.363-1.5,0.375-2.228,0.016c0.938-0.562,0.981-0.957,1.32-2.019c-0.878,0.521-1.851,0.9-2.886,1.104 C18.823,3.053,17.642,2.5,16.335,2.5c-2.51,0-4.544,2.036-4.544,4.544c0,0.356,0.04,0.703,0.117,1.036 C8.132,7.891,4.783,6.082,2.542,3.332C2.151,4.003,1.927,4.784,1.927,5.617c0,1.577,0.803,2.967,2.021,3.782 C3.203,9.375,2.503,9.171,1.891,8.831C1.89,8.85,1.89,8.868,1.89,8.888c0,2.202,1.566,4.038,3.646,4.456 c-0.666,0.181-1.368,0.209-2.053,0.079c0.579,1.804,2.257,3.118,4.245,3.155C5.783,18.102,3.372,18.737,1,18.459 C3.012,19.748,5.399,20.5,7.966,20.5c8.358,0,12.928-6.924,12.928-12.929c0-0.198-0.003-0.393-0.012-0.588 C21.769,6.343,22.835,5.746,23.444,4.834z"/>
                    </g>
                </svg></div>Twitter</div>
            </a>
        </div>

        <nav class="profile-header-nav profile-index-tabs">
            <ul class="nav nav-tabs" role="tablist">

                <li class="active" role="presentation">
                    <a href="#bookshelves" aria-controls="bookshelves" role="tab" data-toggle="tab">
                        BOOKSHELVES
                    </a>
                </li>
                <li role="presentation">
                    <a href="#likes" aria-controls="likes" role="tab" data-toggle="tab">
                        LIKES
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</app-profile-header>