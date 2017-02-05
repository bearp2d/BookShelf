/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Modal component
Vue.component('modal', require('./components/Modal.vue'));

Vue.component('topic-card', require('./components/TopicCard.vue'));
Vue.component('topic-card-modal', require('./components/TopicCardModal.vue'));

// Settings Components
Vue.component('settings-profile-photo', require('./components/settings/SettingsProfilePhoto.vue'));
Vue.component('settings-profile-info', require('./components/settings/SettingsProfileInfo.vue'));
Vue.component('settings-profile-social', require('./components/settings/SettingsProfileSocial.vue'));

// Profile
Vue.component('profile', require('./components/Profile.vue'));
Vue.component('profile-shelves', require('./components/profile/ProfileShelves.vue'));
Vue.component('profile-shelf', require('./components/profile/ProfileShelf.vue'));
Vue.component('profile-likes', require('./components/profile/ProfileLikes.vue'));
Vue.component('profile-like-book', require('./components/profile/ProfileLikeBook.vue'));

// Search
Vue.component('search', require('./components/Search.vue'));
Vue.component('search-book', require('./components/search/SearchBook.vue'));

// Shelf
Vue.component('shelf', require('./components/Shelf.vue'));
Vue.component('shelf-books', require('./components/shelf/ShelfBooks.vue'));
Vue.component('shelf-book', require('./components/shelf/ShelfBook.vue'));

// Modals
Vue.component('edit-shelf-modal', require('./components/modals/EditShelfModal.vue'));
Vue.component('new-shelf-modal', require('./components/modals/NewShelfModal.vue'));
Vue.component('book-save-modal', require('./components/modals/BookSaveModal.vue'));
Vue.component('please-login-modal', require('./components/modals/PleaseLoginModal.vue'));

// Navbar
Vue.component('user-navbar', require('./components/UserNavbar.vue'));

// Shared
Vue.component('spinner', require('./components/shared/Spinner.vue'));
Vue.component('tabs', require('./components/shared/Tabs.vue'));
Vue.component('tab', require('./components/shared/Tab.vue'));

const app = new Vue({
    el: '#app',

    data: {
        user: App.state.user,
        userLikedBooks: [],
        bookSaveModal: false,
        bookSaveModalBook: null,
        plaseLoginModal: false,
        showNewShelfModal: false
    },

    methods: {
        updateUser() {
            this.$http.get('/user/current')
                .then(response => {
                    this.user = response.data;
                });
        },
        loadUserLikedBooks() {
            this.$http.get('/user/current/likes/books')
                .then(response => {
                    this.userLikedBooks = response.data;
                });
        },
        closeBookSaveModal: function () {
            this.bookSaveModal = false;
        },

        showBookSaveModal: function (book) {
            this.bookSaveModalBook = book;
            Bus.$emit('loadUserShelves');
            this.bookSaveModal = true;
        },

        showPleaseLoginModal: function (book) {
            this.plaseLoginModal = true;
        },
        closePleaseLoginModal: function (book) {
            this.plaseLoginModal = false;
        },
        updateUserData: function() {
            this.loadUserLikedBooks();
        }
    },

    /**
     * The component has been created by Vue.
     */
    created: function () {
        // var self = this;
        if (App.userId) {
            this.loadUserLikedBooks();
        }

        Bus.$on('updateUser', this.updateUser);
        Bus.$on('updateUserData', this.updateUserData);
        Bus.$on('showBookSaveModal', this.showBookSaveModal);
        Bus.$on('closeBookSaveModal', this.closeBookSaveModal);
        Bus.$on('showPleaseLoginModal', this.showPleaseLoginModal);
        Bus.$on('closePleaseLoginModal', this.closePleaseLoginModal);
    },

    // It's good to clean up event listeners before
    // a component is destroyed.
    beforeDestroy: function () {
        Bus.$off('updateUser', this.updateUser);
        Bus.$off('updateUserData', this.updateUserData);
        Bus.$off('showBookSaveModal', this.showBookSaveModal);
        Bus.$off('closeBookSaveModal', this.closeBookSaveModal);
        Bus.$off('showPleaseLoginModal', this.showPleaseLoginModal);
        Bus.$off('closePleaseLoginModal', this.closePleaseLoginModal);
    },

    computed: {
        app() {
            return window.App;
        }
    },
});
