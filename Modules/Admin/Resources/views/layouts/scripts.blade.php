
<script src="{{URL::to('admin_ui/vendors/js/vendors.min.js')}}"></script>
<script src="https://www.google.com/jsapi"></script>
<script src="{{URL::to('admin_ui/js/scripts/charts/google/bar/bar.js')}}"></script>
<script src="{{URL::to('admin_ui/js/scripts/charts/google/bar/bar-stacked.js')}}"></script>
<script src="{{URL::to('admin_ui/js/scripts/charts/google/bar/bar-intervals.js')}}"></script>
<script src="{{URL::to('admin_ui/js/scripts/charts/google/bar/column.js')}}"></script>
<script src="{{URL::to('admin_ui/js/scripts/charts/google/bar/stacked-column.js')}}"></script>
<script src="{{URL::to('admin_ui/js/scripts/charts/google/pie/3d-pie.js')}}"></script>
<script src="{{URL::to('admin_ui/js/scripts/charts/google/pie/3d-pie-exploded.js')}}"></script>
<script src="{{URL::to('admin_ui/js/scripts/charts/google/bar/combo.js')}}"></script>
<script src="{{URL::to('admin_ui/vendors/js/charts/chart.min.js')}}"></script>
<script src="{{URL::to('admin_ui/vendors/js/charts/raphael-min.js')}}"></script>
<script src="{{URL::to('admin_ui/vendors/js/charts/morris.min.js')}}"></script>
<script src="{{URL::to('admin_ui/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
<script src="{{URL::to('admin_ui/vendors/js/tables/datatable/datatables.min.js')}}"></script>
@yield('extra_scripts')
<script src="{{URL::to('admin_ui/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js')}}"></script>
<script src="{{ URL::to('admin_ui/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js') }}"></script>
<script src="{{URL::to('admin_ui/data/jvector/visitor-data.js')}}"></script>
<script src="{{URL::to('admin_ui/js/core/app-menu.js')}}"></script>
<script src="{{URL::to('admin_ui/js/core/app.js')}}"></script>
<script src="{{URL::to('admin_ui/dropify/js/dropify.min.js')}}"></script>
<script src="{{URL::to('admin_ui/dropify/dropify.js')}}"></script>
<script src="{{URL::to('admin_ui/summernote/summernote.js')}}"></script>
<script src="{{URL::to('admin_ui/summernote/editor-summernote.js')}}"></script>
<script src="{{URL::to('admin_ui/js/select2.min.js')}}"></script>
<script src="{{ URL::to('admin_ui/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
<script src="{{ URL::to('admin_ui/vendors/js/forms/toggle/switchery.min.js') }}"></script>
<script src="{{ URL::to('admin_ui/js/scripts/forms/switch.js') }}"></script>
<script src="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js') }}"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="{{URL::to('admin_ui/js/scripts/pages/dashboard-sales.js')}}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
</script>

<script>
    function markAsRead() {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('mark.as.read') }}",
            type: 'post',
            data: {
                _token:CSRF_TOKEN,
            },
            dataType: 'JSON',
            success: function (data) {
                $("#markAsRead").html("");
                $("#new").text("");
                $("#new").text(data.count + ' New');
                console.log('i am here');
                $("#markAsRead").append(`<span  class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" >`+data.count+`</span>`);
                $("#media").css("background",'none').fadeIn(500);
            }
        });
    }
</script>

