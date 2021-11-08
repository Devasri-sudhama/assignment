
<script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>

<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js'></script> -->
<script src="./assests/js/signature.js"></script>
<script src="./assests/js/sketch.min.js" type="text/javascript"></script>
<!-- <script src="./assests/js/jquery.min.js" type="text/javascript"></script> -->
    <script type="text/javascript">
        $(function () {
            $('#colors_sketch').sketch();
            $(".tools a").eq(0).attr("style", "color:#000");
            $("#earser").click(function () {
                $(".tools a").removeAttr("style");
                $(this).attr("style", "color:#000");
            });
            $("#earser").bind("click",function (e) {
                e.preventDefault();
                $(".tools a").removeAttr("style");
                $(this).attr("style", "color:#000");
            });
            $("#btnSave").bind("click", function (e) {
                e.preventDefault();
                var base64 = $('#colors_sketch')[0].toDataURL();
                $("#saveimg").attr("src", base64);
                $("#saveimg").val(base64);
                $("#saveimg").show();
            });
        });
    </script>