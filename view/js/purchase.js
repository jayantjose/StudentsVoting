
$(document).ready(function() {
    // $('#purchase-tbl').DataTable( {
    //     "pageLength": 50,
    //     "paging":   true,
    //     "info":     true,
    //     "order": [ 0, "desc" ]
    // } );

    $("#button_add_row").click(function() { 
        
        var maxid = GetHighestID();
        
        var oTable = $('#purchase-tbl').dataTable({
            "pageLength": 50,
            "paging":   true,
            "info":     true,
            "lengthChange": false,
            "searching": false,
            "order": [ 0, "asc" ],
        } );
        oTable.fnPageChange( 0 );
	var tableditTableName = '#purchase-tbl';  // Identifier of table
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
        $(tableditTableName + " tbody tr:first td input[name=txt_purchase_date]").val(strDate);
        $(tableditTableName + " tbody tr:first td input[name=txt_basic_price]").val(0.0);
        $(tableditTableName + " tbody tr:first td input[name=txt_less_discount]").val(0.0);
        $(tableditTableName + " tbody tr:first td input[name=txt_add_freight]").val(0.0);
        $(tableditTableName + " tbody tr:first td input[name=txt_add_percent]").val(0.0);
        $(tableditTableName + " tbody tr:first td input[name=txt_gross_value]").val(0.0);
        $(tableditTableName + " tbody tr:first td input[name=txt_net_value]").val(0.0);

	$(tableditTableName + " tbody tr:first td:last .tabledit-edit-button").trigger("click"); 
        
        BindDataLists();
        
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
    $('input[name=\"txt_gross_value\"]').prop("readonly", true);
    $('input[name=\"txt_net_value\"]').prop("readonly", true);
    $('input[name=\"txt_basic_price\"]').prop("type", "number");
    $('input[name=\"txt_less_discount\"]').prop("type", "number");
    $('input[name=\"txt_add_freight\"]').prop("type", "number");
    $('input[name=\"txt_add_percent\"]').prop("type", "number");
    $('input[name=\"txt_basic_price\"]').prop("step", "0.01");
    $('input[name=\"txt_less_discount\"]').prop("step", "0.01");
    $('input[name=\"txt_add_freight\"]').prop("step", "0.01");
    $('input[name=\"txt_add_percent\"]').prop("step", "0.01");

    $("input[name='txt_purchase_date']").attr("type","date");
    
    // $( "input[name='txt_item']" ).autocomplete({
    //     source: function (request, response)
    //     {
    //          $.ajax(
    //          {
    //              url: 'controller/getitem.php',
    //              dataType: "json",
    //              data:
    //              {
    //                  item: request.term,
    //              },
    //              success: function (data)
    //              {
    //                  response(data);
    //              }
    //          });
    //     }
    // })
    
      
 

    // $( "input[name='txt_supplier']" ).autocomplete({
    //   source: function( request, response ) {
    //          $.ajax(
    //          {
    //              url: 'controller/getsupplier.php',
    //              dataType: "json",
    //              data:
    //              {
    //                  supplier: request.term,
    //              },
    //              success: function (data)
    //              {
    //                  response(data);
    //              }
    //          });
    //      }
    // });
    $('input[name=\"txt_basic_price\"],input[name=\"txt_less_discount\"],input[name=\"txt_add_freight\"],input[name=\"txt_add_percent\"]').keyup(function() {
        var  basic=0;
        var discount=0;
        var freight=0;
        var percent=0;
        basic=parseFloat($(this).closest('tr').find('input[name=\"txt_basic_price\"]').val());
        discount=parseFloat($(this).closest('tr').find('input[name=\"txt_less_discount\"]').val());
        freight=parseFloat($(this).closest('tr').find('input[name=\"txt_add_freight\"]').val());
        percent=parseFloat($(this).closest('tr').find('input[name=\"txt_add_percent\"]').val()/100);
        if(!jQuery.isNumeric(basic)){
            basic=0;
        }
        if(!jQuery.isNumeric(discount)){
            discount=0;
        }
        if(!jQuery.isNumeric(freight)){
            freight=0;
        }
        if(!jQuery.isNumeric(percent)){
            percent=0;
        }

         // basic=parseFloat($('input[name=\"txt_basic_price\"]').val());
         // discount=parseFloat($('input[name=\"txt_less_discount\"]').val());
         // freight=parseFloat($('input[name=\"txt_add_freight\"]').val());
         // percent=parseFloat($('input[name=\"txt_add_percent\"]').val()/100);
         gross=((basic-discount)+(freight));
         net=gross+(gross*percent);
         // if(gross>0) {
             $('input[name=\"txt_gross_value\"]').val(roundToTwo(gross));
         // }
         // if(net>0) {
             $('input[name=\"txt_net_value\"]').val(roundToTwo(net));
         // }
    });
    $('input[name=\"txt_basic_price\"],input[name=\"txt_less_discount\"],input[name=\"txt_add_freight\"],input[name=\"txt_add_percent\"]').change(function() {
        var  basic=0;
        var discount=0;
        var freight=0;
        var percent=0;
        basic=parseFloat($(this).closest('tr').find('input[name=\"txt_basic_price\"]').val());
        discount=parseFloat($(this).closest('tr').find('input[name=\"txt_less_discount\"]').val());
        freight=parseFloat($(this).closest('tr').find('input[name=\"txt_add_freight\"]').val());
        percent=parseFloat($(this).closest('tr').find('input[name=\"txt_add_percent\"]').val()/100);
         // basic=parseFloat($('input[name=\"txt_basic_price\"]').val());
         // discount=parseFloat($('input[name=\"txt_less_discount\"]').val());
         // freight=parseFloat($('input[name=\"txt_add_freight\"]').val());
         // percent=parseFloat($('input[name=\"txt_add_percent\"]').val()/100);
         gross=((basic-discount)+(freight));
         net=gross+(gross*percent);
         if(gross>0) {
             $('input[name=\"txt_gross_value\"]').val(roundToTwo(gross));
         }
         if(net>0) {
             $('input[name=\"txt_net_value\"]').val(roundToTwo(net));
         }
    });

}
function roundToTwo(num) {
    return +(Math.round(num + "e+2")  + "e-2");
}

var selID = 0;

$('#purchase-tbl').Tabledit({
    url: 'controller/save_purchase.php',
    inputClass: 'inPut',
    restoreButton: false,
    columns: {
        identifier: [1, 'txt_id'],
        editable:   [   [2, 'txt_purchase_date'],
                        [3, 'txt_item',items],
                        [4, 'txt_supplier',suppliers],
                        [5, 'txt_basic_price'],
                        [6, 'txt_less_discount'],
                        [7, 'txt_add_freight'],
                        [8, 'txt_gross_value'],
                        [9, 'txt_add_percent'],
                        [10, 'txt_net_value']
                    ]
    },
    onDraw: function() {
        //console.log('onDraw()');
    },
    onSuccess: function(data, textStatus, jqXHR) {
        //console.log('onSuccess(data, textStatus, jqXHR)');
        //console.log(data);
        //console.log(textStatus);
        //console.log(jqXHR);
        //if(data >0) {
            window.location.href = "purchase";
        //}
    },
    onFail: function(jqXHR, textStatus, errorThrown) {
        //console.log('onFail(jqXHR, textStatus, errorThrown)');
        //console.log(jqXHR);
        //console.log(textStatus);
        //console.log(errorThrown);
    },
    onAlways: function() {
        console.log('onAlways()');
    },
    onAjax: function(action, serialize) {
        //console.log('onAjax(action, serialize)');

        // console.log(action);
        // console.log(serialize);
        if (action === 'edit') {
            var queryString = serialize.split('&');

            var p_id    = queryString[0].split('=');
            var p_pdate = queryString[1].split('=');
            var p_item = queryString[2].split('=');
            var p_supplier = queryString[3].split('=');
            var p_basic= queryString[4].split('=');
            var p_discount = queryString[5].split('=');
            var p_freight = queryString[6].split('=');
            var p_gross  = queryString[7].split('=');
            var p_percent = queryString[8].split('=');
            var p_net = typeof queryString[9] !== 'undefined'?queryString[9].split('='):'';

            var id    = p_id[1];
            var pdate = p_pdate[1];
            var item = (p_item[0]=='txt_item'?p_item[1]:'');
            var supplier = (p_supplier[0]=='txt_supplier'?p_supplier[1]:'');
            var basic= p_basic[1];
            var discount = p_discount[1];
            var freight = p_freight[1];
            var gross  = p_gross[1];
            var percent = p_percent[1];
            var net = p_net[1];

            if(pdate=="") {
                alert("Please enter  Date");
                return false;
            }
            if(item=="") {
                alert("Please enter Item");
                return false;
            }
            if(supplier=="") {
                alert("Please enter  Supplier");
                return false;
            }
            if(basic=="") {
                alert("Please enter  Basic Price");
                return false;
            }
            if(discount=="") {
                alert("Please enter  Less Discount");
                return false;
            }
            if(freight=="") {
                alert("Please enter  Add Freight");
                return false;
            }
            if(gross=="") {
                alert("Please enter  Gross Value");
                return false;
            }
            if(percent=="") {
                alert("Please enter  Add Percent");
                return false;
            }
            if(net=="") {
                alert("Please enter  Net Value");
                return false;
            }



        }
    }
});
