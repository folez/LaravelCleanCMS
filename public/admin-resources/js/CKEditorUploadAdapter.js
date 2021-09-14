class LaravelUploadAdapter {

    loader;

    constructor( loader ) {
        this.loader = loader;
    }

    // Starts the upload process.
    upload() {

        return this.loader.file.then( file => new Promise( async ( resolve, reject ) => {
            console.log(file);
            reject("");
            // const formData = new FormData();
            // formData.append('file', file);
            // let url = "";
            // try
            // {
            //     const response = await fetch("",{
            //         method: "POST",
            //         body : formData,
            //     });
            //     url = await  response.text();
            // }catch (error)
            // {
            //     reject(error);
            // }
            // resolve({
            //     default: url
            // });
        }));
    }

    abort() {

    }
}
