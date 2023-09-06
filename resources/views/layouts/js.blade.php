<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<!--Jquery -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<!--DataTable -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js" ></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<!--repeater -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"></script>

<script type="text/javascript" >
    $(document).ready(function(e)  {
        console.log("afef affef")
        $(document).on('click', '#menubutton', function(e)     {
            var a=document.getElementsByClassName('sidbar').item(0);
            a.style.display="block";
            console.log("afasf");
        });


        $(document).click(function(e){
            var width=$(window).width();
            console.log(width)
            if(width<760){
                if ($(e.target).is('.sidbar,.sidbar *,#menubutton')) {
                    console.log("sid");
                    return;
                }
                else
                {
                    document.getElementsByClassName("sidbar").item(0).style.display = 'none';
                }}
        });
    });


</script>
