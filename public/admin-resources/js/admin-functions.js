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
        #ckeditorInstances;

        constructor() {
            this.init();
        }

        get init()
        {
            return (async ()=>{
                this.#body = document.querySelector('body');

                this.#modalInstances = {};
                this.#ckeditorInstances = {};
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
                this.#initCkeditor();


            }).bind(this);
        }

        get #initCkeditor()
        {
            return (async ()=>{
                [...document.querySelectorAll('[data-ckeditor]')].forEach(item=>{
                    const id = item.dataset.ckeditorId;

                    ClassicEditor
                        .create( item, {
                            // plugins: ['Strikethrough'],
                            toolbar: {
                                items: [
                                    'heading',
                                    '|',
                                    'bold',
                                    'strikethrough',
                                    'italic',
                                    'underline',
                                    'link',
                                    'bulletedList',
                                    'numberedList',
                                    '|',
                                    'alignment',
                                    'outdent',
                                    'indent',
                                    '|',
                                    'blockQuote',
                                    'undo',
                                    'redo',
                                    'fontBackgroundColor',
                                    'fontColor',
                                    'fontSize',
                                    'fontFamily'
                                ]
                            },
                            /*toolbar: [
                                "heading", "|", "alignment:left", "alignment:center", "alignment:right", "alignment:adjust", "|", "bold", "italic", "strikethrough", "link", "|", "bulletedList", "numberedList", "imageUpload", "|", "undo", "redo"],*/
                            language: 'ru',
                            // extraPlugins: [ this.#customUploadPlugin ]
                        })
                        .then(instance=>{
                            this.#ckeditorInstances[id] = instance;
                            // this.ckEditorInstances[id] = instance;
                        }).catch(error=>{

                    });
                });
            }).bind(this);
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

        get ckeditorInstances()
        {
            return (()=>this.#ckeditorInstances).bind(this)
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

        // event : {
        // 'selector' : /*simple selector*/,
        // 'action' : 'show'|'hide'|null
        // }
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

        // get bindCkEditor()
        // {
        //     return ((livewireComponent,propertyName,id)=>{
        //         adminFunctions.ckeditorInstances()[id].model.document.on( 'change:data', () => {
        //             livewireComponent.set(propertyName, adminFunctions.ckeditorInstances()[id].getData());
        //         } );
        //     }).bind(this);
        // }

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
