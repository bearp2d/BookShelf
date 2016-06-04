<app-profile-header :user=user inline-template>
    <div class="profile-header">
        <div class="container">
            <div class="container-inner">
                <img class="img-circle media-object" src="{{ asset('img/avatar-dhg.png') }}">
                <h3 class="profile-header-user">Tigran Hakobyan</h3>
                <p class="profile-header-bio">
                    I wish i was a little bit taller, wish i was a baller, wish i had a girl… also.
                </p>
            </div>
        </div>

        <nav class="profile-header-nav">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#">Bookshelves</a>
                </li>
                <li>
                    <a href="#">Likes</a>
                </li>
            </ul>
        </nav>
    </div>
</app-profile-header>