let original_data = {}, newData={};

function editRow(row,id){
    console.log({"data": newData,id});
    const _data = newData.product_name !== id ? {data: newData,id, new_name:newData.product_name}: {data: newData,id};
    $.ajax({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        data: _data,
        url : "/api/products/update",
        type: 'PUT',
        dataType: 'json',
        success : function(data){
            console.log('results:',data);
            original_data = data[0];
            row.find('.total_value').text(data[0].product_price*data[0].product_quantity);
            if(data[0].product_name !== id) row.attr('row_id', data[0].product_name);
        }
    });
}

const getData = (row)=>{
    const data = {};
    row.find('.editable').each((index,val)=>{
        const column = $(val).attr('col_id');
        data[column] = $(val).html();
    });
    return data;
}
const onSaveClick=(row,id)=>{
    newData = getData(row);
    editRow(row,id);
}

const renderTable = data=>{
    $('#products-container').html(data.table_view);
    console.log(data)
}
$(document).ready(()=>{
    $.ajax({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        url : "/api/products",
        dataType: 'json',
        success : renderTable
    });

    $('#submit_btn').click((e)=>{
        e.preventDefault();
        const product_name = $("input[name='product_name']").val();
        const product_quantity = $("input[name='product_quantity']").val();
        const product_price = $("input[name='product_price']").val();
        const data = {
            product_name,
            product_price,
            product_quantity
        };
        console.log(data);
        $.ajax({
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            data: {data},
            url : "/api/products/add",
            type: 'POST',
            dataType: 'json',
            success : function(data){
                const row = $('<tr></tr>').attr('row_id',data[0].product_name);
                const editBtn = $('<td></td>').html($('<button></button>').text('Edit').addClass('edit-btn btn btn-primary'));
                const productName = $('<td></td>').text(data[0].product_name).addClass('editable').attr('col_id','product_name');
                const productQuantity = $('<td></td>').text(data[0].product_quantity).addClass('editable').attr('col_id','product_quantity');
                const productPrice = $('<td></td>').text(data[0].product_price).addClass('editable').attr('col_id','product_price');
                const productCreated = $('<td></td>').text(data[0].product_created);
                const productTotalVal = $('<td></td>').text(data[0].product_price*data[0].product_quantity).addClass('total-value');
                row.append(editBtn,productName,productQuantity,productPrice,productCreated,productTotalVal);
                $('#products-container tbody tr').last().after(row);
                console.log(data)
            }
        });
    });
    $(document).on('click',".edit-btn",function(e){
        e.preventDefault();
        const row = $(this).closest('tr');
        const id = row.attr('row_id');
        const reset= ()=>{
            row.find('.editable').attr('contenteditable',false);
            $(this).text('Edit');
            row.find('.editable').each((index,val)=>{
                $(val).html(original_data[$(val).attr('col_id')]);
            });
        }
        if($(this).html() == 'Update'){
            if((original_data['product_name']!==newData['product_name'])
                || (original_data['product_price']!==newData['product_price'])
                || (original_data['product_quantity']!==newData['product_quantity']))
            {
                onSaveClick(row,id);
            }
            reset();
            return;
        }
        $(this).text('Update');

        row.find('.editable').attr('contenteditable',true);
       
        original_data = getData(row);

        $(row).on('focusout',function(element){
            setTimeout(()=>{
                if($(document.activeElement).is('td.editable')) return;
                reset();
            },1)
        });
        console.log("original data:", original_data);
    });
});
    