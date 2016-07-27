/**
 * Export the root App application.
 */
module.exports = {
    el: 'body',

    /**
     * The application's data.
     */
    data: {
        user: App.state.user,
        loadingNotifications: false,
        notifications: null,

        supportForm: new AppForm({
            from: '',
            subject: '',
            message: ''
        })
    },

    /**
     * The component has been created by Vue.
     */
    created() {
        if (App.userId) {
            this.loadDataForAuthenticatedUser();
        }
    },


    /**
     * Prepare the application.
     */
    ready() {
        console.log('Application Ready.');
        this.whenReady();
    },


    events: {
        /*
         * Update the current user of the application.
         */
        updateUser() {
            this.getUser();
        },

        /**
         * Show the application's notifications.
         */
        showNotifications() {
            $('#modal-notifications').modal('show');
            this.markNotificationsAsRead();
        },

        /**
         * Show the customer support e-mail form.
         */
        showSupportForm() {
            if (this.user) {
                this.supportForm.from = this.user.email;
            }

            $('#modal-support').modal('show');

            setTimeout(() => {
                $('#support-subject').focus();
            }, 500);
        },

        showCreateShelfModal() {
            this.$broadcast('showCreateNewShelfModal');
        },

        reloadUserShelves() {
            this.$broadcast('reloadUserShelves');
        }
    },


    methods: {
        /**
         * Finish bootstrapping the application.
         */
        whenReady() {
            //
        },


        /**
         * Load the data for an authenticated user.
         */
        loadDataForAuthenticatedUser() {
            this.getNotifications();
        },


        /*
         * Get the current user of the application.
         */
        getUser() {
            this.$http.get('/user/current')
                .then(response => {
                    this.user = response.data;
                });
        },


        /**
         * Get the application notifications.
         */
        getNotifications() {
            this.loadingNotifications = true;

            this.notifications = {'notifications': []};

            this.loadingNotifications = false;
            // this.$http.get('/notifications/recent')
            //     .then(response => {
            //         this.notifications = response.data;

            //         this.loadingNotifications = false;
            //     });
        },

        /**
         * Mark the current notifications as read.
         */
        markNotificationsAsRead() {
            if ( ! this.hasUnreadNotifications) {
                return;
            }

            this.$http.put('/notifications/read', {
                notifications: _.pluck(this.notifications.notifications, 'id')
            });

            _.each(this.notifications.notifications, notification => {
                notification.read = 1;
            });
        },

        /**
         * Send a customer support request.
         */
        sendSupportRequest() {
            App.post('/support/email', this.supportForm)
                .then(() => {
                    $('#modal-support').modal('hide');

                    this.showSupportRequestSuccessMessage();

                    this.supportForm.subject = '';
                    this.supportForm.message = '';
                });
        },

    },


    computed: {
        /**
         * Determine if the user has any unread notifications.
         */
        hasUnreadAnnouncements() {
            if (this.notifications && this.user) {
                if (! this.user.last_read_announcements_at) {
                    return true;
                }

                return _.filter(this.notifications.announcements, announcement => {
                    return moment.utc(this.user.last_read_announcements_at).isBefore(
                        moment.utc(announcement.created_at)
                    );
                }).length > 0;
            }

            return false;
        },


        /**
         * Determine if the user has any unread notifications.
         */
        hasUnreadNotifications() {
            if (this.notifications) {
                return _.filter(this.notifications.notifications, notification => {
                    return ! notification.read;
                }).length > 0;
            }

            return false;
        }
    }
};
