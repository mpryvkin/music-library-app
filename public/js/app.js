jQuery(function($){
    'use strict';

    /* Site */
    var Site = {
        init: function(){
            // Include CSRF (cross-site request forgery) token in every ajax (POST) request
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Initialize controls
            Site.initControls();

            // Initialize current page
            Site.initPage();
        },

        initControls: function(){


        },

        // Initializes current page
        initPage: function(){
            var $body = $(document.body);

            if($body.hasClass('page-bands')){
                Site.PageBands.init();

            } else if($body.hasClass('page-bands-edit')){
                Site.PageBandsEdit.init();

            } else if($body.hasClass('page-albums')){
                Site.PageAlbums.init();

            } else if($body.hasClass('page-albums-edit')){
                Site.PageAlbumsEdit.init();
            }
        },

        PageBands: {
            init: function(){
                var dt = $('#dt-bands').DataTable({
                    'ajax': '/bands/data',
                    'columns': [
                        { 
                            'data': 'name',
                            'width': '40%'
                        },
                        {
                            'data': 'start_date',
                            'width': '10%',
                            'type': 'num',
                            'searchable': false,
                            'render': {
                                '_': 'display',
                                'sort': 'timestamp'
                            }
                        },
                        { 
                            'data': 'website',
                            'width': '30%'
                        },
                        { 
                            'data': 'still_active',
                            'width': '10%'
                        },
                        {
                            'data': null,
                            'width': '10%',
                            'defaultContent': 
                                '<button type="button" class="btn btn-xs btn-primary btn-edit mrm"><i class="glyphicon glyphicon-pencil"></i></button>'
                                + '<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="glyphicon glyphicon-remove"></i></button>'
                        }
                    ]
                });

                $('#dt-bands').on('click', '.btn-edit', function(){
                    var data = dt.row($(this).closest('tr')).data();
                    window.location = '/bands/edit/' + encodeURI(data['id']);
                });

                $('#dt-bands').on('click', '.btn-delete', function(){
                    if(confirm('Are you sure you want to delete this band?')){
                        var data = dt.row($(this).closest('tr')).data();
                        window.location = '/bands/delete/' + encodeURI(data['id']);
                    }
                });
            }
        },

        PageBandsEdit: {
            init: function(){
                $('#band-start-date').pickadate({
                    clear: '',
                    format: 'mm/dd/yyyy',
                    formatSubmit: 'yyyy-mm-dd',
                    hiddenName: true
                });
            }
        },

        PageAlbums: {
            init: function(){
                var dt = $('#dt-albums').DataTable({
                    'ajax': '/albums/data',
                    'columns': [
                        { 
                            'data': 'name',
                            'width': '40%'
                        },
                        { 
                            'data': 'band_id',
                            'visible': false
                        },
                        { 
                            'data': 'band_name',
                            'width': '30%'
                        },
                        { 
                            'data': 'genre',
                            'width': '10%'
                        },
                        {
                            'data': 'release_date',
                            'width': '10%',
                            'type': 'num',
                            'searchable': false,
                            'render': {
                                '_': 'display',
                                'sort': 'timestamp'
                            }
                        },
                        {
                            'data': null,
                            'width': '10%',
                            'defaultContent': 
                                '<button type="button" class="btn btn-xs btn-primary btn-edit mrm"><i class="glyphicon glyphicon-pencil"></i></button>'
                                + '<button type="button" class="btn btn-xs btn-danger btn-delete"><i class="glyphicon glyphicon-remove"></i></button>'
                        }
                    ]
                });

                $('#dt-albums').on('click', '.btn-edit', function(){
                    var data = dt.row($(this).closest('tr')).data();
                    window.location = '/albums/edit/' + encodeURI(data['id']);
                });

                $('#dt-albums').on('click', '.btn-delete', function(){
                    if(confirm('Are you sure you want to delete this album?')){
                        var data = dt.row($(this).closest('tr')).data();
                        window.location = '/albums/delete/' + encodeURI(data['id']);
                    }
                });

                $('#album-band').on('change', function(){
                    dt.column(1).search($(this).val()).draw();
                });
            }
        },

        PageAlbumsEdit: {
            init: function(){
                $('#album-release-date, #album-recorded-date').pickadate({
                    clear: '',
                    format: 'mm/dd/yyyy',
                    formatSubmit: 'yyyy-mm-dd',
                    hiddenName: true
                });
            }
        }
    };

    Site.init();
});
