<script src="<?php echo base_url('assets/js/plugin/webfont/webfont.min.js') ?>"></script>
<script>
WebFont.load({
    google: {
        families: ["Public Sans:300,400,500,600,700"]
    },
    custom: {
        families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
        ],
        urls: ["<?php echo base_url('assets/css/fonts.min.css') ?>"],
    },
    active: function() {
        sessionStorage.fonts = true;
    },
});
</script>
<!-- ApexCharts CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.css">

<!-- ApexCharts JS -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!-- CSS Files -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/plugins.min.css') ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/kaiadmin.min.css') ?>" />

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/demo.css') ?>" />
<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/core/jquery-3.7.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/core/popper.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/core/bootstrap.min.js') ?>"></script>

<!-- jQuery Scrollbar -->
<script src="<?php echo base_url('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') ?>"></script>

<!-- Chart JS -->
<script src="<?php echo base_url('assets/js/plugin/chart.js/chart.min.js') ?>"></script>

<!-- jQuery Sparkline -->
<script src="<?php echo base_url('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') ?>"></script>

<!-- Chart Circle -->
<script src="<?php echo base_url('assets/js/plugin/chart-circle/circles.min') ?>.js"></script>

<!-- Datatables -->
<script src="<?php echo base_url('assets/js/plugin/datatables/datatables.min.js') ?>"></script>

<!-- Bootstrap Notify -->
<script src="<?php echo base_url('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') ?>"></script>

<!-- jQuery Vector Maps -->
<script src="<?php echo base_url('assets/js/plugin/jsvectormap/jsvectormap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugin/jsvectormap/world.js') ?>"></script>

<!-- Sweet Alert -->
<script src=" <?php echo base_url('assets/js/plugin/sweetalert/sweetalert.min.js') ?>">
</script>

<!-- Kaiadmin JS -->
<script src="<?php echo base_url('assets/js/kaiadmin.min.js') ?>"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url('assets/js/setting-demo.js') ?>"></script>
<script src="<?php echo base_url('assets/js/demo.js') ?>">
</script>
<script>
$("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#177dff",
    fillColor: "rgba(23, 125, 255, 0.14)",
});

$("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#f3545d",
    fillColor: "rgba(243, 84, 93, .14)",
});

$("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#ffa534",
    fillColor: "rgba(255, 165, 52, .14)",
});
</script>

<script>
$(document).ready(function() {
    $("#basic-datatables").DataTable({});

    $("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-select"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });

    // Add Row
    $("#add-row").DataTable({
        pageLength: 5,
    });

    var action =
        '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

    $("#addRowButton").click(function() {
        $("#add-row")
            .dataTable()
            .fnAddData([
                $("#addName").val(),
                $("#addPosition").val(),
                $("#addOffice").val(),
                action,
            ]);
        $("#addRowModal").modal("hide");
    });
});
</script>