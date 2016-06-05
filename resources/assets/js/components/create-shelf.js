Vue.component('app-create-shelf', {
    props: ['user'],

    data() {
        return {
            form: new AppForm({
                name: '',
                description: '',
                cover_color: '',
            })
        };
    },


    methods: {

        create() {
            App.post('/shelf/store', this.form)
                .then(() => {
                    $('#modal-create-shelf').modal('hide');

                    this.showCreateSuccessMessage();

                    this.form.name = '';
                    this.form.description = '';
                });
        },

        showCreateSuccessMessage() {
            swal({
                title: 'Got It!',
                text: 'Your bookshelf has successfully created.',
                type: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        }
    },

});
