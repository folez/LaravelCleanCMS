'use strict';

let MyCustomUploadAdapterPlugin = ( editor ) => {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new LaravelUploadAdapter( loader );
    };
}

const adminFunctions =
(()=>{

    class Preferences {
        /* isSidenavFolded */
        set isSidenavFolded(value){
            localStorage.setItem('isSideNavFolded',value);
        }
        get isSidenavFolded(){
            let value = localStorage.getItem('isSideNavFolded');
            return value != null ? value == 'true' : false;
        }

    }

    class AdminFunctions {
        #body;
        #modalInstances;
        #canWriteToClipboard;
        preferences;
        #tinymceInstances;

        constructor() {
            this.init();
        }

        get init()
        {
            return (async ()=>{
                this.#body = document.querySelector('body');

                this.#modalInstances = {};
                this.#tinymceInstances = {};
                this.preferences = new Preferences();

                this.#restoreFoldedState();

                this.#canWriteToClipboard = true;
                    // (await navigator.permissions.query({name:'geolocation'})).state == 'granted';

                window.addEventListener('resize',()=>{
                    if(window.matchMedia('(max-width: 992px)').matches)
                        this.#body.classList.remove('sidebar-folded');
                    else
                        this.#restoreFoldedState();
                });


                this.#reportInitState();
                this.#initTinymce();


            }).bind(this);
        }

        get #initTinymce()
        {
            return (async () => {
                [...document.querySelectorAll('[data-tiny]')].forEach(item => {
                    const id = item.dataset.tinymceId;
                    const imageUpload = item.dataset.isUpload;

                    let options = {
                        selector: `#${id}`,
                        language : "ru",
                        element_format : 'html',
                        skin: 'oxide',
                        width : "100%",
                        theme: 'silver',
                        height : 400,
                        setup: (editor) => {
                            editor.on('init change', function () {
                                editor.save();
                            });
                            this.#tinymceInstances[id] = editor;
                        },
                        plugins: [
                            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                            'searchreplace wordcount visualblocks visualchars code fullscreen media',
                        ],
                        contextmenu: 'image link imagetools table spellchecker lists',
                        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
                        branding: false,
                    };

                    if(imageUpload) {
                        options = {
                            selector: `#${id}`,
                            language : "ru",
                            element_format : 'html',
                            skin: 'oxide',
                            width : "100%",
                            theme: 'silver',
                            height : 400,
                            setup: (editor) => {
                                editor.on('init change', function () {
                                    editor.save();
                                });
                                this.#tinymceInstances[id] = editor;
                            },
                            plugins: [
                                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                'searchreplace wordcount visualblocks visualchars code fullscreen media',
                            ],
                            contextmenu: 'image link imagetools table spellchecker lists',
                            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
                            branding: false,
                            file_picker_callback : function(callback, value, meta) {
                                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                                var cmsURL = '/admin/' + 'filemngr?editor=' + meta.fieldname;
                                if (meta.filetype == 'image') {
                                    cmsURL = cmsURL + "&type=Images";
                                } else {
                                    cmsURL = cmsURL + "&type=Files";
                                }

                                tinyMCE.activeEditor.windowManager.openUrl({
                                    url : cmsURL,
                                    title : 'Загрузка файлов',
                                    width : x * 0.8,
                                    height : y * 0.8,
                                    resizable : "yes",
                                    close_previous : "no",
                                    onMessage: (api, message) => {
                                        callback(message.content);
                                    }
                                });
                            }
                        }
                    }

                    tinymce.init(options);
                })
            });
        }

        get #customUploadPlugin()
        {
            return ((editor)=>{
                editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                    // Configure the URL to the upload script in your back-end here!
                    console.log(loader)
                    return new LaravelUploadAdapter( loader );
                };
            }).bind(this);
        }

        get #restoreFoldedState()
        {
            return (async ()=>{
                if(this.preferences.isSidenavFolded&&window.matchMedia('(min-width: 992px)').matches)
                    this.toggleSidebar(true);
            }).bind(this);
        }

        get tinymceInstances()
        {
            return (()=>this.#tinymceInstances).bind(this)
        }

        #reportInitState()
        {
            if(this.#body == null)
                throw 'Cant get body!';

            if(!this.#canWriteToClipboard)
                console.error("Can't copy to clipboard!\n");

            console.info('AdminFunctions initialized');
        }

        get toggleSidebar()
        {
            return ((silent = false)=>
            {
                if (window.matchMedia('(min-width: 992px)').matches) {
                    this.#body.classList.toggle('sidebar-folded');
                    if(!silent)
                        this.preferences.isSidenavFolded = !this.preferences.isSidenavFolded;
                } else if (window.matchMedia('(max-width: 991px)').matches) {
                    this.#body.classList.toggle('sidebar-open');
                }
            }).bind(this);
        }

        // bind context to function
        get livewireModalListiner(){
            return ((event)=>
            {
                // ? if instance not exsist create it
                if(!this.#modalInstances[event.selector])
                    this.#modalInstances[event.selector] = new bootstrap.Modal(document.querySelector(event.selector));
                // ? get instance
                const modal = this.#modalInstances[event.selector];
                switch (event.action)
                {
                    case 'show':
                    case 'open':
                        modal.show();
                        break;
                    case 'hide':
                    case 'close':
                        modal.hide();
                        break;
                    default:
                        modal.toggle();
                        break;
                }
            }).bind(this);
        }

        get setupListiners(){
            return (()=>
            {
                window.livewire.on('bs-modal',this.livewireModalListiner);
                return this;
            }).bind(this);
        }

        get listenDropdownValueSetter()
        {
            return ((livewireComponent,dropdowns)=>{
                livewireComponent.on('dropdown-set-value',(args)=>dropdowns[args.name]?.setChoiceByValue(`${args.value}`));
            }).bind(this);
        }

        get copyToClipboard(){
            if(this.#canWriteToClipboard)
                return (async (valueToCopy)=>{
                    try
                    {
                        await navigator.clipboard.writeText(valueToCopy);
                        await Swal.fire({
                            title: 'Value copied to clipboard',
                            icon:'success',
                            toast: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                        });
                    }catch(e)
                    {
                        console.error(e);
                        //TODO: fallback
                    }
                }).bind(this);
            return (valueToCopy)=>{
                console.error("Can't copy to clipboard");
            };
        }

    }


    // ? return object that contains functions
    return (new AdminFunctions()).setupListiners();
})();
