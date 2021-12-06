
document.addEventListener('DOMContentLoaded', function () {
    filterData();

    function getFilter() {
        let filter = [];
        document.querySelectorAll('.filter-checkbox-chip:checked').forEach( function(el){
            filter.push(el.value);
        })
        return filter;
    }

    function filterData() {
        let category = [];
        document.querySelectorAll('.filter-checkbox-chip:checked').forEach( function(el){
            category.push(el.value);
        })
        const action = 'filter-products';
        $.ajax({
            url:'models/FilterProducts.php',
            method: 'POST',
            data: {action:action, category: category},
            success:function (data) {
                $('.products-wrapper').html(data);
            }
        });
    }

    $('.filter-chip').click(function (){
        filterData();
    })
}, false);





