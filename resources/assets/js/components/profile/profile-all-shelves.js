Vue.component('app-profile-all-shelves', {
    props: ['user'],

    /**
     * The component's data.
     */
    data() {
        return {
            shelves: [],
            updatingShelf: null,
            deletingShelf: null,
            updateShelfForm: new AppForm({
                name: '',
                description: '',
            }),
            deleteShelfForm: new AppForm({}),
        }
    },


    methods: {

        /**
         * Get all bookshelves for the user.
         */
        getUserShelves() {
            this.$http.get(`/users/${this.user.id}/shelves`)
                .then(function(response) {
                    this.shelves = response.data;
                });
        },

        /**
         * Show the edit shelf modal.
         */
        editShelf(shelf) {
            this.updatingShelf = shelf;

            this.initializeUpdateFormWith(shelf);

            $('#modal-update-shelf').modal('show');
        },


        /**
         * Initialize the edit form with the given shelf.
         */
        initializeUpdateFormWith(shelf) {
            this.updateShelfForm.name = shelf.name;
            this.updateShelfForm.description = shelf.description;
        },


        /**
         * Update the shelf being edited.
         */
        updateShelf() {
            App.put(`/shelves/${this.updatingShelf.id}`, this.updateShelfForm)
                .then(() => {
                    this.getUserShelves();
                    $('#modal-update-shelf').modal('hide');
                })
        },

        /**
         * Get user confirmation that the shelf should be deleted.
         */
        approveShelfDelete(shelf) {
            this.deletingShelf = shelf;
            $('#modal-delete-shelf').modal('show');
        },


        /**
         * Delete the specified shelf.
         */
        deleteShelf() {
            App.delete(`/shelves/${this.deletingShelf.id}`, this.deleteShelfForm)
                .then(() => {
                    this.getUserShelves();
                    $('#modal-delete-shelf').modal('hide');
                });
        },

        onOwnProfile() {
            return App.userId === this.user.id;
        }
    },

    events: {

        /**
         * Handle this component becoming the active tab.
         */
        appHashChanged(hash) {
            if (hash == 'bookshelves' && this.shelves.length === 0) {
                this.getUserShelves();
            }
        },

        reloadUserShelves() {
            this.getUserShelves();
        },

    },

});
