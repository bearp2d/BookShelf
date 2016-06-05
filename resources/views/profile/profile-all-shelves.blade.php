<app-profile-all-shelves inline-template>
    <div class="container m-y-md" v-if="shelves.length > 0">
        <div class="m-t">
            <div class="row">

            <div class="col-md-6" v-for="shelf in shelves">
                <div class="panel panel-default panel-profile">
                    <div class="panel-heading" style="background-image: url(https://igcdn-photos-h-a.akamaihd.net/hphotos-ak-xfa1/t51.2885-15/11312291_348657648678007_1202941362_n.jpg);">
                    </div>
                    <div class="panel-body text-center">
                        <img class="panel-profile-img" src="{{ asset('img/avatar-dhg.png') }}">
                        <h5 class="panel-title">@{{ shelf.name }}</h5>
                        <p class="m-b-md">@{{ shelf.description }}</p>
                        <button class="btn btn-primary-outline btn-sm">
                            <span class="icon icon-add-user"></span> Follow
                        </button>
                        <button class="btn btn-primary" @click="editShelf(shelf)">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button class="btn btn-danger-outline" @click="approveShelfDelete(shelf)">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>

    <!-- Update Token Modal -->
    <div class="modal" id="modal-update-shelf" tabindex="-1" role="dialog">
        <div class="modal-dialog" v-if="updatingShelf">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                        Edit Bookshelf (@{{ updatingShelf.name }})
                    </h4>
                </div>

                <div class="modal-body">
                    <!-- Update Shelf Form -->
                    <form class="form-horizontal" role="form">
                        <!-- Shelf Name -->
                        <div class="form-group" :class="{'has-error': updateShelfForm.errors.has('name')}">
                            <label class="col-md-4 control-label">Shelf Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" v-model="updateShelfForm.name">

                                <span class="help-block" v-show="updateShelfForm.errors.has('name')">
                                    @{{ updateShelfForm.errors.get('name') }}
                                </span>
                            </div>
                        </div>

                        <!-- Shelf Description -->
                        <div class="form-group" :class="{'has-error': updateShelfForm.errors.has('description')}">
                            <label class="col-md-4 control-label">Shelf Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="description" v-model="updateShelfForm.description">
                                </textarea>

                                <span class="help-block" v-show="updateShelfForm.errors.has('description')">
                                    @{{ updateShelfForm.errors.get('description') }}
                                </span>
                            </div>
                        </div>

                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary" @click="updateShelf" :disabled="updateShelfForm.busy">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Shelf Modal -->
    <div class="modal fade" id="modal-delete-shelf" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" v-if="deletingShelf">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                        Delete Bookshelf (@{{ deletingShelf.name }})
                    </h4>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete this bookshelf?
                </div>

                <!-- Modal Actions -->
                <div class="modal-actions">
                    <button type="button" class="btn-default modal-action" data-dismiss="modal">No, Go Back</button>

                    <button type="button" class="btn-danger modal-action" @click="deleteShelf" :disabled="deleteShelfForm.busy">
                        Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</app-profile-all-shelves>
