! function (o) {
    "use strict";

    function e() {
        this.$body = o("body"), this.charts = []
    }
    e.prototype.initCharts = function () {
        window.Apex = {
            chart: {
                parentHeightOffset: 0,
                toolbar: {
                    show: !1
                }
            },
            grid: {
                padding: {
                    left: 0,
                    right: 0
                }
            },
            colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]
        };
        var
            t, r = {
                chart: {
                    height: 256,
                    type: "bar",
                    stacked: !0
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: "20%"
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    show: !0,
                    width: 2,
                    colors: ["transparent"]
                },
                series: [{
                    name: "Jumlah Siswa",
                    data: [65, 59, 80, 81, ]
                }],
                zoom: {
                    enabled: !1
                },
                legend: {
                    show: !1
                },
                olors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"],
                // colors: e = (t = o("#kehadiran").data("colors")) ? t.split(",") : e,
                xaxis: {
                    categories: ["Hadir", "Sakit", "Izin", "Alfa"],
                    axisBorder: {
                        show: !1
                    }
                },
                fill: {
                    opacity: 1
                },
            },
            e = (new ApexCharts(document.querySelector("#kehadiran"), r).render(), ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]);
    }, e.prototype.initMaps = function () {}, e.prototype.init = function () {
        this.initCharts(), this.initMaps()
    }, o.Dashboard = new e, o.Dashboard.Constructor = e
}(window.jQuery),
function (t) {
    "use strict";
    t(document).ready(function (e) {
        t.Dashboard.init()
    })
}(window.jQuery);
