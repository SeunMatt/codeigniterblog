
var ExcelUploader = function(params){

    check_required_libs();

    let X = XLSX;
    let batch = 0; //the current batch
    let groups = 0; //total number of batches
    let maxInAGroup = params.maxInAGroup || 1000;
    let start = 0; //indicate the start of the slice of the whole data
    let stop = maxInAGroup; //the stop index for the slice of the whole data for a batch
    let errorArray = [];
    let columnHeaders = [];
    let data = [];
    let fileName = "";
    let serverColumnNames = params.serverColumnNames || [
        ["Name", "name"], ["Email", "email"], ["Address", "address"],
        ["Phone", "phone"], ["Company Name", "company_name"],
        ["Company Address", "company_address"],
        ["Industry", "industry"],
        ["Employer ID", "employer_id"]
    ];

    let columnMap = "";
    let importTypeSelector = params.importTypeSelector || "#dataType";
    let fileChooserSelector = params.fileChooserSelector || "#fileUploader";
    let tableOutputSelector = params.outputSelector || "#tableOutput";

    console.log(params);
    console.log(maxInAGroup);
    console.log(serverColumnNames);
    console.log(importTypeSelector);
    console.log(fileChooserSelector);
    console.log(tableOutputSelector);

    $(tableOutputSelector).css("margin", "30px");

    $(fileChooserSelector).on("click", function () {
        if(!$(importTypeSelector).val()) {
            alerter("Select A Data Type First");
            return false;
        }
    });


    $(fileChooserSelector).on("change", function () {


        $(tableOutputSelector).html("");
        if($(tableOutputSelector + " #smx_progress-block").length <= 0) {
            $(tableOutputSelector).append("" +
                "<div id='smx_progress-block' class='form-group'>" +
                "<label>Parsing File</label>" +
                "<div class='progress' style='height:20px;'>" +
                "<div id='smx_progress-parsing' class='progress-bar progress-bar-striped active' role='progressbar' " +
                "aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width:100%'>" +
                "</div></div></div><br><br>"
            );
        }

        let rABS = true; //readAsBinaryString
        let reader = new FileReader();

        //obtain the file object
//                let file = document.getElementById("fileUploader").files[0];
        let file = $(fileChooserSelector).prop("files")[0];

        if(!file) {
            alerter("No File Selected!");
            return false;
        }

        if(!verifyFile(file)) {
            alerter("Invalid File Selected!");
            return false;
        }

        fileName = file.name;

        reader.onload = function (e) {

            //get the binary data
            let data = e.target.result;

            //parse the data as a workbook
            try {
                let wb = X.read(data, {type: rABS ? 'binary' : 'array'});

                //update progress
                $("#smx_progress-parsing").html("Reading Data From File Completed Successfully");
                $("#smx_progress-parsing").removeClass("active");

                //process the workbook
                processWorkbookData(wb);

            } catch(e) {
                console.log(e);
                alerter("Error Reading/Processing Excel File! Try again or use file");
                return false;
            }
        };

        reader.onerror = function (error) {
            $("#smx_progress-parsing").addClass("progress-bar-danger");
            $("#smx_progress-parsing").removeClass("active");
            $("#smx_progress-parsing").html("ERROR reading the File!");
            console.log(JSON.stringify(error));
        };

        $("#smx_progress-parsing").addClass("active");
        $("#smx_progress-parsing").removeClass("progress-bar-danger");
        $("#smx_progress-parsing").css("display", "initial");
        $("#smx_progress-parsing").parent().css("display", "initial");
        $("#smx_progress-parsing").html("Reading Data From File . . .");

        //read it using the FileReader as a Binary
        reader.readAsBinaryString(file);

    });


    $(document).on("click", "#smx_downloadErrorDataExcelBt", function() {
        downloadErrorData();
    });

    $(document).on("click", "#smx_finalizeBt", function (event) {
        event.preventDefault();
        //set the columnMap
        columnMap = prepareColumnMap();

        if(!columnMap) {
            return false;
        }
        initUpload();
    });

    $(document).on("click", "#smx_redoBt", function () {
        window.location.reload();
    });


    function displayErrorData() {
        //the data is going to be an array of array
        //[ [], [] ... ]

        if(errorArray.length > 0) {
            $(tableOutputSelector).append("<br><p style='color:red;'>There are " + errorArray.length + " records with error. " +
                "These are most likely data with duplicated entries." +
                " Click the red button below to download those data as excel<br><br>");
            $(tableOutputSelector).append("<button style='margin-right: 30px;' id='smx_downloadErrorDataExcelBt' " +
                "class='btn btn-danger btn-large btn-fill'>Download Error Data</button>");
        }
    }

    function errorDataToHtmlTable() {
        let tableStr = "<table class='errorTable'><tbody>";
        for(let i = 0; i < errorArray.length; i++) {
            let td = "";
            if(Array.isArray(errorArray[i])) {
                for (let j = 0; j < errorArray[i].length; j++) {
                    td = td + "<td>" + errorArray[i][j] + "</td>";
                }
            } else {
                td = td + "<td>" + errorArray[i] + "</td>";
            }

            tableStr = tableStr + "<tr>" + td + "</tr>";
        }

        tableStr = tableStr + "</tbody></table>";
        $(tableOutputSelector).append(tableStr);
    }

    function downloadErrorData() {

        if(errorArray.length <= 0) {
            alerter("There's no Error to download");
            return false;
        }

        let new_ws = X.utils.json_to_sheet(errorArray, {skipHeader:true, raw: true});

        /* build workbook */
        let new_wb = X.utils.book_new();
        X.utils.book_append_sheet(new_wb, new_ws, 'Data with Errors');

        /* write file and trigger a download */
        let wbout = X.write(new_wb, {bookType:'xlsx', bookSST:true, type:'binary'});
        let fname = 'error_data.xlsx';

        try {
            saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), fname);
        } catch(e) {
            console.log(e, wbout);
            alerter("Error Saving Excel File Locally");
        }
    }

    function setDefaults() {
        X = XLSX;
        batch = 0;
        groups = 0;
        start = 0;
        stop = maxInAGroup;
    }

    function verifyFile(file) {
        let extTemp = file.type.split(".");
        let fileType = extTemp[extTemp.length - 1];

        let nameTemp = file.name.split(".");
        let ext = nameTemp[nameTemp.length - 1];

        return ((fileType == "sheet" || fileType == "ms-excel") && (ext == "xlsx" || ext == "xls"));

    }

    function showColumnMapping(data) {

        let dynamicOptions = "";
        serverColumnNames.forEach(function(element) {
            //the value of the options is going to be the displayed
            //value in lower case and spaces replaced with underscore char
            let regex = new RegExp(" ", "g");
            let eVal = element.toLowerCase().replace(regex, "_");
            dynamicOptions += "<option value='" + eVal + "'>" + element + "</option>";
        });
        dynamicOptions +=  "<option value='-1'>Ignore</option>";

        let dynamicTB = "";
        for(let i = 0; i < data[1].length; i++){
            dynamicTB += "<tr><td>" + data[1][i] + "</td><td><strong>==></strong></td><td><select class='smx_col-maps' data-index='" + i + "'>" + dynamicOptions + "</select></td></tr>";
        }

        $(tableOutputSelector).append("<br><table class='table table-bordered table-striped table-responsive'>" +
            "<thead><tr><th>This Data On Excel</th><th>Represent</th><th>What?</th><tr></thead>" +
            "<tbody>" + dynamicTB
            + "</tbody></table>" +
            "<br>========================= <br>" +
            new Date() + "<br>FileName: " + fileName +
            "<br>Total No of Records: " + (data.length - 1) +
            "<br>=========================<br>" +
            "<p id='tableError' style='color:red;'></p>"
            + "<button id='smx_finalizeBt' class='btn btn-success btn-large btn-fill'>Finalize</button>"
        );
    }

    function prepareColumnMap() {
        let colMap = "{";
        let err = false;
        $(".smx_col-maps").removeClass("error");
        $("#tableError").html("");

        $(".smx_col-maps").each(function (data) {
            let entry = $(this).val();
            if(entry != "-1") {
                let regex = new RegExp("\\b" + entry + "\\b");
                if(colMap.search(regex) > 0) {
                    $(this).addClass("error");
                    $("#tableError").html("<strong>ERROR! You have mapped more than one Data to the same type. See the row highlighted in RED</strong>");
                    alerter("ERROR! You have mapped more than one Data to the same type. See the row highlighted in RED");
                    err = true;
                    return false;
                }
                colMap += '"' + $(this).val() + '":"' + $(this).data("index") + '",';
            }
        });
        if(!err) {
            return colMap.substring(0, (colMap.length - 1)) + "}";
        } else {
            return false;
        }
    }

    function initUpload() {

        $(tableOutputSelector).append("<br><br>" +
            "<div id='smx_upload-block' class='form-group'>" +
            "<label>Uploading . . .</label><br>" +
            "<div id='progress' class='progress' style='height:20px;'>"+
            "<div id='smx_progress-upload' class='progress-bar progress-bar-striped active' role='progressbar'"+
            "aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:3%'>"+
            "</div></div></div>" +
            "<br><br>");

        $(fileChooserSelector + ", " + importTypeSelector + ", #smx_finalizeBt, .smx_col-maps").attr("disabled", "disabled");


        //remove the headers
        data.splice(0,1);

        //get the result of the division
        //if there are remainders, add 1 to the division to care for them
        groups = parseInt(data.length / maxInAGroup) + ((data.length % maxInAGroup) > 0 ? 1 : 0);

        //reset views
        $("#smx_upload-block label").html("Uploading...");
        $("#smx_progress-upload").html("");
        $("#smx_progress-upload").parent().css("display", "initial");
        $("#smx_progress-upload").css("display", "initial");
        $("#smx_progress-upload").css("width", "3%");
        $("#smx_downloadErrorDataExcelBt").css("display", "none");

        //ignite the chain
        callPushDataToServer();
    }

    //string to array buffer
    function s2ab(s) {
        var b = new ArrayBuffer(s.length), v = new Uint8Array(b);
        for (var i=0; i != s.length; ++i) v[i] = s.charCodeAt(i) & 0xFF;
        return b;
    }

    function check_required_libs () {
        if(!window.XLSX || !$ || !saveAs) {
            let error = "Missing Libs! \n jQuery " +
                "\nhttps://github.com/SheetJS/js-xlsx " +
                "\nhttp://purl.eligrey.com/github/FileSaver.js/blob/master/FileSaver.js" +
                "\n is required!";
            console.log(error);
            alert(error);
            return false;
        }
    }

    function processWorkbookData(wb) {

        //empty the error array
        errorArray = [];

        /* get worksheet */
        let ws = wb.Sheets[wb.SheetNames[0]];

        //export the worksheet data as json
        data = X.utils.sheet_to_json(ws, {header: 1, raw: true});

        //extract the headers
        columnHeaders = data[0];
        if(columnHeaders.length <= 0) {
            alerter("The first row in the document is EMPTY. It should contain the Headers");
            return false;
        }

        if(data.length <= 1 || data[1].length <= 0) {
            alerter("The Excel Sheet Seems to have no data");
            return false;
        }

        //show Mapping
        showColumnMapping(data);

    }

    function callPushDataToServer() {

        if(batch >= groups) {
            //just in case, but this is handled in update_progress
            //We are done processing
            return false;
        }

        //extract the next batch from the whole data
//                console.log("Pushing batch " + batch + " to server | start = " + start + " stop = " + stop);
        let currentData = data.slice(start, stop);
        setTimeout(pushDataToServer(currentData), 1000);

        //increase the index for the next batch so we know where we are
        start = stop;
        stop = stop + maxInAGroup;
    }

    function pushDataToServer(data) {

        let url = $(importTypeSelector).val();

        if(!url  || url == "-1") { //just in case someone find a way to select this
            alerter("You did not select the right Data to Import");
            return false;
        }

        $.ajax({
            url: url,
            type: "POST",
            data: {"data" : JSON.stringify(data), "_token" : CSRF_TOKEN, "column_map": columnMap},
            success: function (response) {
                //just to be sure
                if(response.data) {
                    errorArray = errorArray.concat(response.data);
                }
                if(response.error) {
                    alerter(JSON.stringify(response.error));
                    console.log(response.error);
                }
                updateProgress();
            },
            error: function (error) {
                alerter("ERROR OCCURRED! " + JSON.stringify(error) + "<br>");
                console.log(error);
                updateProgress();
            }
        });
    }

    function updateProgress() {
        //this method is called when the server returned a response
        //either success or failure

        //increase the batch
        batch = batch + 1;

        //calculate the width of the progress bar and percentage done
        //it is safe to do this here as batch starts from 0
        let width = parseInt((batch / groups) * 100);
        $("#smx_progress-upload").css("width", width + "%");
        $("#smx_upload-block label").html("Uploading " + batch + " of " + groups);
        $("#smx_progress-upload").html(width + "%");

        if(batch >= groups) {

            //if the current batch is greater than or equal to the number of available groups
            //then we are done
            $("#smx_progress-upload").removeClass("active");

            //display any errors
            displayErrorData();
            $(tableOutputSelector).append("<button id='smx_redoBt' class='btn btn-success btn-large btn-fill'>Upload Another File</button>");
            setDefaults();
        }
        else {
            //call the next guy in the queue
            callPushDataToServer();
        }
    }

    function alerter(message) {
        if(window.swal) {
            swal("Alert!", message, "warning");
        } else {
            alert(message);
        }
    }
};










