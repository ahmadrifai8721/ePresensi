@section("pluginsJS")
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/gh/wxtan2/Client-Side-Table-Pagination/table-pagination.js"></script>

<script>
    $('#table').createTablePagination({
        rowPerPage: 10,
        paginationColor: '#6f7ad7',
        // fontColor: '#ffffff',
        paginationStyle: 'borderless',
        transitionDuration: 300,
        // jumpPage: true
    });
</script>
@endsection