
document.addEventListener('DOMContentLoaded', function () {
    filterData();

    function getFilter() {
        let filter = [];
        document.querySelectorAll('.filter-checkbox-chip:checked').forEach( function(el){
            console.log(el.value);
            filter.push(el.value);
        })
        return filter;
    }

    function filterData() {
        const action = 'filter-products';
        let category = getFilter();
        $.ajax({
            url:'models/BasisSQL.php',
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





