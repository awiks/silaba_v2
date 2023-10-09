@if(Session::has('success'))
<script type="text/javascript" charset="utf-8" async defer>
  $(function() {
    $.notify("{{session('success')}}",{
      position:"top center",
      className :"success"
    });
  });
</script>
@endif

@if (Session::has('error'))
<script type="text/javascript" charset="utf-8" async defer>
    $(function() {
    $.notify("{{session('error')}}",{
        position:"top center",
        className :"error"
    });
    });
</script>
@endif

@if (Session::has('warning'))
<script type="text/javascript" charset="utf-8" async defer>
  $(function() {
    $.notify("{{session('warning')}}",{
      position:"top center",
      className :"warning"
    });
  });
</script>
@endif

@if (Session::has('info'))
<script type="text/javascript" charset="utf-8" async defer>
$(function() {
  $.notify("{{session('info')}}",{
    position:"top center",
    className :"info"
  });
});
</script>
@endif
