
$(document).ready(function() {
   
    $("#button_add_row").click(function() { 

        if($("#doc_num").val() != "0" ){
            var maxid = GetHighestID();

            var oTable = $('#shipment-tbl').dataTable();
            oTable.fnPageChange( 0 );
            var tableditTableName = '#shipment-tbl';  // Identifier of table
            //var newID = parseInt($(tableditTableName + " tr:last").attr("id")) + 1; 
            //var newID = maxid + 1;

            var newID = 0;
            var clone = $("table tr:last").clone(); 
            $(".tabledit-span", clone).text(""); 
            $(".tabledit-input", clone).val(""); 
            clone.prependTo("table"); 
            $(tableditTableName + " tbody tr:first").attr("id", newID); 
            $(tableditTableName + " tbody tr:first td .tabledit-span.tabledit-identifier").text(newID); 
            $(tableditTableName + " tbody tr:first td .tabledit-input.tabledit-identifier").val(newID); 

            var strDate = $.datepicker.formatDate('yy-mm-dd', new Date());
            $(tableditTableName + " tbody tr:first td input[name=txt_status_date]").val(strDate);
        
            $(tableditTableName + " tbody tr:first td:last .tabledit-edit-button").trigger("click"); 

            BindDataLists();
        }
        else {
            //alert("Please select a Docket Number");
        }
        
    });
    
    BindDataLists();
   
} );    

function GetHighestID() {
    var  maxid=0;
    $.ajax({
        dataType: "json",
        type : 'Get',
        url: 'controller/getlast_purchaseid.php',
        async: false,
        success: function(data) {
            maxid = data;
        },
        error: function(data) {

        }
    });    
    return  maxid;
}

function BindDataLists() {
    $("input[name='txt_status_date']").attr("type","date");
    
    $( "input[name='txt_loc_s']" ).autocomplete({
        source: function (request, response)
        {
             $.ajax(
             {
                 url: 'controller/getstate.php',
                 dataType: "json",
                 data:
                 {
                     term: request.term,
                 },
                 success: function (data)
                 {
                     response(data);
                 }
             });
        }        
    }); 

    $( "input[name='txt_loc_c']" ).autocomplete({
        source: function (request, response)
        {
             $.ajax(
             {
                 url: 'controller/getcity.php',
                 dataType: "json",
                 data:
                 {
                     term: request.term,
                 },
                 success: function (data)
                 {
                     response(data);
                 }
             });
        }
    });

}

var selID = 0;
$('#shipment-tbl').Tabledit({
    url: 'controller/update_shipment.php?doc_no='+ $("#doc_num").val(),
    inputClass: 'inPut',
    columns: {
        identifier: [0, 'txt_id'],
        editable:   [   
                        [1, 'txt_loc_s'], 
                        [2, 'txt_loc_c'], 
                        [3, 'txt_status_date'],
                        [4, 'txt_status','{"Departed": "Departed", "In Transist": "In Transist", "Out for Delivery": "Out for Delivery", "Delivered": "Delivered"}']
                    ]
    },
    onDraw: function() {
        console.log('onDraw()');
    },
    onSuccess: function(data, textStatus, jqXHR) {
        console.log('onSuccess(data, textStatus, jqXHR)');
        console.log(data);
        console.log(textStatus);
        console.log(jqXHR);
        //if(data >0) {
            window.location.href = "update";
        //}
    },
    onFail: function(jqXHR, textStatus, errorThrown) {
        console.log('onFail(jqXHR, textStatus, errorThrown)');
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
    },
    onAlways: function() {
        console.log('onAlways()');
    },
    onAjax: function(action, serialize) {
        console.log('onAjax(action, serialize)');
        console.log(action);
        console.log(serialize);
        if (action === 'edit') {
            var queryString = serialize.split('&');
            
            var p_id    = queryString[0].split('=');
            var p_state = queryString[1].split('=');
            var p_city  = queryString[2].split('=');
            var p_sdate = queryString[3].split('=');
            var p_status= queryString[4].split('=');

            
            var id    = p_id[1];
            var state = p_state[1];
            var city  = p_city[1];
            var sdate = p_sdate[1];
            var status = p_status[1];
            
            if(state=="") {
                alert("Please enter  State");
                return false;
            }
            if(city=="") {
                alert("Please enter  City");
                return false;
            }
            if(sdate=="") {
                alert("Please enter  Date");
                return false;
            }
            if(status=="") {
                alert("Please enter  Status");
                return false;
            }
            


        }
    }
});
