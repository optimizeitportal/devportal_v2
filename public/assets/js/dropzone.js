$(function () {

    // preventing page from redirecting
    $("html").on("dragover", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $("h1").text("Drag here");
    });

    $("html").on("drop", function (e) { e.preventDefault(); e.stopPropagation(); });

    // Drag enter
    $('.upload-area').on('dragenter', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("h1").text("Drop");
    });

    // Drag over
    $('.upload-area').on('dragover', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $("h1").text("Drop");
    });

    // Drop
    $('.upload-area').on('drop', function (e) {
        ShowNoDataText();
        e.stopPropagation();
        e.preventDefault();
        $("h1").text("Upload");

        var file = e.originalEvent.dataTransfer.files;
        var fd = new FormData();

        var files = file[0];
        var error_flag = false;
        // checking file type
        var filetype = files.type;
        var extension = files.name.split('.').pop().toLowerCase();
    
        // checking file size
        var fsize = files.size;
        //var cfsize = convertSize(fsize);
        fd.append('file', files);

        // Validation Process Starts
        if (fsize > 2000000) {
            $('.note').html("<i class='fa fa-exclamation-triangle'></i> File is too big. Max filesize is 2 MB.");
            $('.note').css("color", "red");
            error_flag = true;  // if there is an error, error_flag is true
        }else{

            var reader = new FileReader();
            if (filetype == 'image/jpeg' || filetype == 'image/jpg' || filetype == 'image/png' || filetype == 'image/tiff') {
                // show image
                var output = $('<img />');
                // show image
                reader.onload = function () {
                    if(filetype == 'image/tiff' && extension =="tiff"){
                        Tiff.initialize({
                            TOTAL_MEMORY: 2000000
                        });
                        var tiff = new Tiff({
                            buffer: reader.result
                        });
                        var tiffCanvas = tiff.toDataURL();
            
                        output.attr('src', tiffCanvas)
                        
                    }else{
                        output.attr('src', reader.result)
                    }
                };
                 
                (filetype == 'image/tiff' && extension =="tiff" ) ? reader.readAsArrayBuffer(files): reader.readAsDataURL(files);
                
                $('.doc_image').html(output);

                if (error_flag == false) {
            
                    uploadData(fd); // Uploading Process function
                }

            } 
            else if(filetype=="application/pdf"){
                    // check pdf number of pages
                    reader.onload = function () {

                        //Step 4:turn array buffer into typed array
                        var typedarray = new Uint8Array(this.result);
                        //Step 5:pdfjs should be able to read this
                        const loadingTask = pdfjsLib.getDocument(typedarray);

                        loadingTask.promise.then(pdf => {
                            if(pdf.numPages > 10){
                                error_flag = true;
                                $('.note').html("<i class='fa fa-exclamation-triangle'></i> The PDF Pages is exceeds maximum limit. Maximum allowed PDF Pages is 10 Upload.").css("color", "red");
                            }else{
                                if (error_flag == false) {
                       
                                    uploadData(fd); // Uploading Process function
                                }
                            }
                            // The document is loaded here...
                        });
                    };
                    //Step 3:Read the file as ArrayBuffer
                    reader.readAsArrayBuffer(files);
            }
            else {
                $('.note').html("<i class='fa fa-exclamation-triangle'></i> Supported file types are PDF, JPEG, PNG, or TIFF.");
                $('.note').css("color", "red");
                error_flag = true;  // if there is an error, error_flag is true
                error_flag = true;  // if there is an error, error_flag is true
            }
        }

    });

    // Open file selector on div click
    $("#uploadfile").click(function () {
        $("#file").click();
    });

    // file selected
    $("#file").change(function (e) {
        ShowNoDataText();
        var fd = new FormData();

        var files = $('#file')[0].files[0];
        var error_flag = false;
        // Validation Process Starts
        // checking file type
        var filetype = files.type;
        // checking file size
        var fsize = files.size;
        //var cfsize = convertSize(fsize);
        fd.append('file', files);
        if (fsize > 2000000) {
            $('.note').html("<i class='fa fa-exclamation-triangle'></i> File is too big. Max filesize is 2 MB.");
            $('.note').css("color", "red");
            error_flag = true;  // if there is an error, error_flag is true
        }else{
            var extension = files.name.split('.').pop().toLowerCase();
            var reader = new FileReader();
            if (filetype == 'image/jpeg' || filetype == 'image/jpg' || filetype == 'image/png' || filetype == 'image/tiff') {

                var output = $('<img />');
                // show image
                reader.onload = function () {
                    if(filetype == 'image/tiff' && extension =="tiff"){
                        // Load Tiff image
                        Tiff.initialize({
                            TOTAL_MEMORY: 2000000
                        });
                        var tiff = new Tiff({
                            buffer: reader.result
                        });
                        var tiffCanvas = tiff.toDataURL();
                        // set attr for Tiff img element
                        output.attr('src', tiffCanvas)
                        
                    }else{
                        // set attr for others img element
                        output.attr('src', reader.result)
                    }
                };
                // Check tiff image
                (filetype == 'image/tiff' && extension =="tiff") ? reader.readAsArrayBuffer(e.target.files[0]): reader.readAsDataURL(e.target.files[0]);
                console.log(e.target.files[0])
                // output image in element
                $('.doc_image').html(output);
                
                // Validation process ends
                if (error_flag == false) {
                    uploadData(fd); // Uploading Process function
                }
            } 
            else if(filetype=="application/pdf"){
                    // check pdf number of pages
                    reader.onload = function () {

                        //Step 4:turn array buffer into typed array
                        var typedarray = new Uint8Array(this.result);
                        //Step 5:pdfjs should be able to read this
                        const loadingTask = pdfjsLib.getDocument(typedarray);

                        loadingTask.promise.then(pdf => {
                            if(pdf.numPages > 10){
                                error_flag = true; 
                                $('.note').html("<i class='fa fa-exclamation-triangle'></i> Document has "+pdf.numPages+" pages, which is more than 10 allowed!.").css("color", "red");
                            }else{
                                    // Validation process ends
                                    if (error_flag == false) {
                                        uploadData(fd); // Uploading Process function
                                    }
                            }
                            // The document is loaded here...
                        });
                    };
                    //Step 3:Read the file as ArrayBuffer
                    reader.readAsArrayBuffer(e.target.files[0]);
            }
            else {
                $('.note').html("<i class='fa fa-exclamation-triangle'></i> Supported file types are PDF, JPEG, PNG, or TIFF.");
                $('.note').css("color", "red");
                error_flag = true;  // if there is an error, error_flag is true
                error_flag = true;  // if there is an error, error_flag is true
            }
        }

        
    });
});

// Sending AJAX request and upload file
// function uploadData(formdata){
// $('.note').html('<div align=\"center\"><img src=\"images/spinner.gif\"></div>');
//     $.ajax({
//         url: 'file-upload.php',
//         type: 'post',
//         data: formdata,
//         contentType: false,
//         processData: false,
//        // dataType: 'json',
//         success: function(response){
//             //addThumbnail(response);
// 	$('.note').html(response);
//         }
//     });
// }



// Added thumbnail
function addThumbnail(data) {
    $("#uploadfile h1").remove();
    var len = $("#uploadfile div.thumbnail").length;

    var num = Number(len);
    num = num + 1;

    var name = data.name;
    var size = convertSize(data.size);
    var src = data.src;

    // Creating an thumbnail
    $("#uploadfile").append('<div id="thumbnail_' + num + '" class="thumbnail"></div>');
    $("#thumbnail_" + num).append('<img src="' + src + '" width="100%" height="78%">');
    $("#thumbnail_" + num).append('<span class="size">' + size + '<span>');

}

// Bytes conversion
function convertSize(size) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (size == 0) return '0 Byte';
    var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
    return (size / Math.pow(1024, i), 2) + ' ' + sizes[i];
}
