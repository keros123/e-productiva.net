/**
 * Dashboard Analytics
 */

"use strict";

(function () {
  let totalRevenueChart = null;
  let statisticsChart = null;
  const fecha = new Date();
  const year = fecha.getFullYear();
  let cardColor, headingColor, axisColor, shadeColor, borderColor;
  cardColor = config.colors.white;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;

  const MostrarDatos = (year) => {
    let mensaje;
    let objdatos = new FormData();
    objdatos.append("listarSeguimientos", "ok");
    objdatos.append("yearG1", year);

    fetch(config.rutes["controllerGraficas"], {
      method: "POST",
      body: objdatos,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error;
      })
      .then((response) => {
        if (response["codigo"] == "200") {
          let vectMeses = [];
          let vectRealizados = [];
          let vectPendientes = [];
          let resultado = 0;
          var meses = [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
          ];
          response["listaSeguimientos"].forEach((item) => {
            if (item.mes != null) {
              vectMeses.push(meses[item.mes - 1]);
              vectRealizados.push(item.realizados);
              resultado = item.pendientes * 2;
              vectPendientes.push(item.pendientes - resultado);
            }
          });

          const totalRevenueChartEl =
              document.querySelector("#totalRevenueChart"),
            totalRevenueChartOptions = {
              series: [
                {
                  name: "Seguimientos Realizados",
                  data: vectRealizados,
                },
                {
                  name: "Seguimientos Pendientes",
                  data: vectPendientes,
                },
              ],
              chart: {
                height: 500,
                stacked: true,
                type: "bar",
                toolbar: { show: false },
              },
              plotOptions: {
                bar: {
                  horizontal: false,
                  columnWidth: "33%",
                  borderRadius: 12,
                  startingShape: "rounded",
                  endingShape: "rounded",
                },
              },
              colors: [config.colors.primary, config.colors.info],
              dataLabels: {
                enabled: false,
              },
              stroke: {
                curve: "smooth",
                width: 6,
                lineCap: "round",
                colors: [cardColor],
              },
              legend: {
                show: true,
                horizontalAlign: "left",
                position: "top",
                markers: {
                  height: 8,
                  width: 8,
                  radius: 12,
                  offsetX: -3,
                },
                labels: {
                  colors: axisColor,
                },
                itemMargin: {
                  horizontal: 10,
                },
              },
              grid: {
                borderColor: borderColor,
                padding: {
                  top: 0,
                  bottom: -8,
                  left: 20,
                  right: 20,
                },
              },
              xaxis: {
                categories: vectMeses,
                labels: {
                  style: {
                    fontSize: "13px",
                    colors: axisColor,
                  },
                },
                axisTicks: {
                  show: false,
                },
                axisBorder: {
                  show: false,
                },
              },
              yaxis: {
                labels: {
                  style: {
                    fontSize: "13px",
                    colors: axisColor,
                  },
                },
              },
              responsive: [
                {
                  breakpoint: 1700,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 10,
                        columnWidth: "32%",
                      },
                    },
                  },
                },
                {
                  breakpoint: 1580,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 10,
                        columnWidth: "35%",
                      },
                    },
                  },
                },
                {
                  breakpoint: 1440,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 10,
                        columnWidth: "42%",
                      },
                    },
                  },
                },
                {
                  breakpoint: 1300,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 10,
                        columnWidth: "48%",
                      },
                    },
                  },
                },
                {
                  breakpoint: 1200,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 10,
                        columnWidth: "40%",
                      },
                    },
                  },
                },
                {
                  breakpoint: 1040,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 11,
                        columnWidth: "48%",
                      },
                    },
                  },
                },
                {
                  breakpoint: 991,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 10,
                        columnWidth: "30%",
                      },
                    },
                  },
                },
                {
                  breakpoint: 840,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 10,
                        columnWidth: "35%",
                      },
                    },
                  },
                },
                {
                  breakpoint: 768,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 10,
                        columnWidth: "28%",
                      },
                    },
                  },
                },
                {
                  breakpoint: 640,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 10,
                        columnWidth: "32%",
                      },
                    },
                  },
                },
                {
                  breakpoint: 576,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 10,
                        columnWidth: "37%",
                      },
                    },
                  },
                },
                {
                  breakpoint: 480,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 10,
                        columnWidth: "45%",
                      },
                    },
                  },
                },
                {
                  breakpoint: 420,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 10,
                        columnWidth: "52%",
                      },
                    },
                  },
                },
                {
                  breakpoint: 380,
                  options: {
                    plotOptions: {
                      bar: {
                        borderRadius: 10,
                        columnWidth: "60%",
                      },
                    },
                  },
                },
              ],
              states: {
                hover: {
                  filter: {
                    type: "none",
                  },
                },
                active: {
                  filter: {
                    type: "none",
                  },
                },
              },
            };
          if (
            typeof totalRevenueChartEl !== undefined &&
            totalRevenueChartEl !== null
          ) {
            if (totalRevenueChart != null) {
              totalRevenueChart.destroy();
            }
            totalRevenueChart = new ApexCharts(
              totalRevenueChartEl,
              totalRevenueChartOptions
            );
            totalRevenueChart.render();
          }
        } else {
          console.log("error");
        }
      });
  };

  // Total Revenue Report Chart - Bar Chart
  // --------------------------------------------------------------------
  MostrarDatos(year);

  // Growth Chart - Radial Bar Chart
  // --------------------------------------------------------------------
  const growthChartEl = document.querySelector("#growthChart"),
    growthChartOptions = {
      series: [78],
      labels: ["Growth"],
      chart: {
        height: 240,
        type: "radialBar",
      },
      plotOptions: {
        radialBar: {
          size: 150,
          offsetY: 10,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: "55%",
          },
          track: {
            background: cardColor,
            strokeWidth: "100%",
          },
          dataLabels: {
            name: {
              offsetY: 15,
              color: headingColor,
              fontSize: "15px",
              fontWeight: "600",
              fontFamily: "Public Sans",
            },
            value: {
              offsetY: -25,
              color: headingColor,
              fontSize: "22px",
              fontWeight: "500",
              fontFamily: "Public Sans",
            },
          },
        },
      },
      colors: [config.colors.primary],
      fill: {
        type: "gradient",
        gradient: {
          shade: "dark",
          shadeIntensity: 0.5,
          gradientToColors: [config.colors.primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100],
        },
      },
      stroke: {
        dashArray: 5,
      },
      grid: {
        padding: {
          top: -35,
          bottom: -10,
        },
      },
      states: {
        hover: {
          filter: {
            type: "none",
          },
        },
        active: {
          filter: {
            type: "none",
          },
        },
      },
    };
  if (typeof growthChartEl !== undefined && growthChartEl !== null) {
    const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
    growthChart.render();
  }

  // Profit Report Line Chart
  // --------------------------------------------------------------------
  const profileReportChartEl = document.querySelector("#profileReportChart"),
    profileReportChartConfig = {
      chart: {
        height: 80,
        // width: 175,
        type: "line",
        toolbar: {
          show: false,
        },
        dropShadow: {
          enabled: true,
          top: 10,
          left: 5,
          blur: 3,
          color: config.colors.warning,
          opacity: 0.15,
        },
        sparkline: {
          enabled: true,
        },
      },
      grid: {
        show: false,
        padding: {
          right: 8,
        },
      },
      colors: [config.colors.warning],
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 5,
        curve: "smooth",
      },
      series: [
        {
          data: [110, 270, 145, 245, 205, 285],
        },
      ],
      xaxis: {
        show: false,
        lines: {
          show: false,
        },
        labels: {
          show: false,
        },
        axisBorder: {
          show: false,
        },
      },
      yaxis: {
        show: false,
      },
    };
  if (
    typeof profileReportChartEl !== undefined &&
    profileReportChartEl !== null
  ) {
    const profileReportChart = new ApexCharts(
      profileReportChartEl,
      profileReportChartConfig
    );
    profileReportChart.render();
  }

  // Order Statistics Chart
  // --------------------------------------------------------------------
  // const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
  //     orderChartConfig = {
  //         chart: {
  //             height: 165,
  //             width: 130,
  //             type: 'donut'
  //         },
  //         labels: ['Electronic', 'Sports', 'Decor', 'Fashion'],
  //         series: [85, 15, 50, 50],
  //         colors: [config.colors.primary, config.colors.secondary, config.colors.info, config.colors.success],
  //         stroke: {
  //             width: 5,
  //             colors: cardColor
  //         },
  //         dataLabels: {
  //             enabled: false,
  //             formatter: function(val, opt) {
  //                 return parseInt(val) + '%';
  //             }
  //         },
  //         legend: {
  //             show: false
  //         },
  //         grid: {
  //             padding: {
  //                 top: 0,
  //                 bottom: 0,
  //                 right: 15
  //             }
  //         },
  //         plotOptions: {
  //             pie: {
  //                 donut: {
  //                     size: '75%',
  //                     labels: {
  //                         show: true,
  //                         value: {
  //                             fontSize: '1.5rem',
  //                             fontFamily: 'Public Sans',
  //                             color: headingColor,
  //                             offsetY: -15,
  //                             formatter: function(val) {
  //                                 return parseInt(val) + '%';
  //                             }
  //                         },
  //                         name: {
  //                             offsetY: 20,
  //                             fontFamily: 'Public Sans'
  //                         },
  //                         total: {
  //                             show: true,
  //                             fontSize: '0.8125rem',
  //                             color: axisColor,
  //                             label: 'Weekly',
  //                             formatter: function(w) {
  //                                 return '38%';
  //                             }
  //                         }
  //                     }
  //                 }
  //             }
  //         }
  //     };
  // if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
  //     const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
  //     statisticsChart.render();
  // }

  const MostrarGrafica = (year) => {
    let mensaje;
    let objdatos = new FormData();
    objdatos.append("listarGrafica", "ok");
    objdatos.append("yearG2", year);

    fetch(config.rutes["controllerGraficas"], {
      method: "POST",
      body: objdatos,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error;
      })
      .then((response) => {
        if (response["codigo"] == "200") {
          console.log(response);
          let vectDatos = [];
          let totalSeguimientos = 0;
          response["listaGrafica"].forEach((item) => {
            vectDatos.push(item.seguimientos_realizados);
            vectDatos.push(item.seguimientos_pendientes);
            vectDatos.push(item.vencidos_sin_entrega);
            totalSeguimientos =
              item.seguimientos_realizados +
              item.seguimientos_pendientes +
              item.vencidos_sin_entrega;
            $("#totalRealizados").html(item.seguimientos_realizados);
            $("#totalVencidos").html(item.vencidos_sin_entrega);
            $("#totalPendientes").html(item.seguimientos_pendientes);

            // Actualizar barras de progreso proporcionales
            if (totalSeguimientos > 0) {
              let pctRealizados = (item.seguimientos_realizados / totalSeguimientos * 100).toFixed(1);
              let pctVencidos   = (item.vencidos_sin_entrega   / totalSeguimientos * 100).toFixed(1);
              let pctPendientes = (item.seguimientos_pendientes / totalSeguimientos * 100).toFixed(1);
              $("#barRealizados").css("width", pctRealizados + "%");
              $("#barVencidos").css("width", pctVencidos + "%");
              $("#barPendientes").css("width", pctPendientes + "%");
            }
          });

          const chartOrderStatistics = document.querySelector(
              "#orderStatisticsChart"
            ),
            orderChartConfig = {
              chart: {
                height: 350,
                width: "100%",
                type: "donut",
              },
              labels: ["Realizados", "Pendientes", "Vencidos"],
              series: vectDatos,
              colors: [
                config.colors.primary,
                config.colors.info,
                config.colors.danger,
              ],
              stroke: {
                width: 5,
                colors: cardColor,
              },
              dataLabels: {
                enabled: false,
                formatter: function (val, opt) {
                  return parseInt(val);
                },
              },
              legend: {
                show: false,
              },
              grid: {
                padding: {
                  top: 0,
                  bottom: 0,
                  right: 15,
                },
              },
              plotOptions: {
                pie: {
                  donut: {
                    size: "65%",
                    labels: {
                      show: true,
                      value: {
                        fontSize: "1.5rem",
                        fontFamily: "Public Sans",
                        color: headingColor,
                        offsetY: -15,
                        formatter: function (val) {
                          return parseInt(val);
                        },
                      },
                      name: {
                        offsetY: 20,
                        fontFamily: "Public Sans",
                      },
                      total: {
                        show: true,
                        fontSize: "0.8125rem",
                        color: axisColor,
                        label: "Seguimientos",
                        formatter: function (w) {
                          return totalSeguimientos;
                        },
                      },
                    },
                  },
                },
              },
            };
          if (
            typeof chartOrderStatistics !== undefined &&
            chartOrderStatistics !== null
          ) {
            if (statisticsChart != null) {
              statisticsChart.destroy();
            }
            statisticsChart = new ApexCharts(
              chartOrderStatistics,
              orderChartConfig
            );
            statisticsChart.render();
          }
        }
      });
  };
  MostrarGrafica(year);

  // polarArea -  chart
  // --------------------------------------------------------------------

  const MostrarDatosCertificaciones = () => {
    let objdatos = new FormData();
    objdatos.append("listarResumenCertificacion", "ok");

    fetch(config.rutes["controllerGraficas"], {
      method: "POST",
      body: objdatos,
    })
      .then((response) => response.json())
      .then((response) => {
        console.log(response);
        if (response && response["codigo"] == "200") {
          let vectDatos = [];
          let Aprendices = 0;
          vectDatos.push(response["Certificados"][0]);
          vectDatos.push(response["PorCertificar"][0]);
          Aprendices = response["PorCertificar"][0] + response["Certificados"][0];
          $("#totalCertificados").html(response["Certificados"][0]);
          $("#totalPorCertificar").html(response["PorCertificar"][0]);

          const chartOrderStatistics = document.querySelector(
              "#certificadosProcesoGrafica"
            ),
            orderChartConfig = {
              chart: {
                height: 220,
                width: 185,
                type: "donut",
              },
              labels: ["Certificados", "Por Certificar"],
              series: vectDatos,
              colors: [
                config.colors.primary,
                config.colors.success
              ],
              stroke: {
                width: 5,
                colors: cardColor,
              },
              dataLabels: {
                enabled: false,
                formatter: function (val, opt) {
                  return parseInt(val);
                },
              },
              legend: {
                show: false,
              },
              grid: {
                padding: {
                  top: 0,
                  bottom: 0,
                  right: 15,
                },
              },
              plotOptions: {
                pie: {
                  donut: {
                    size: "65%",
                    labels: {
                      show: true,
                      value: {
                        fontSize: "1.5rem",
                        fontFamily: "Public Sans",
                        color: headingColor,
                        offsetY: -15,
                        formatter: function (val) {
                          return parseInt(val);
                        },
                      },
                      name: {
                        offsetY: 20,
                        fontFamily: "Public Sans",
                      },
                      total: {
                        show: true,
                        fontSize: "0.8125rem",
                        color: axisColor,
                        label: "Aprendices",
                        formatter: function (w) {
                          return Aprendices;
                        },
                      },
                    },
                  },
                },
              },
            };
          if (
            typeof chartOrderStatistics !== undefined &&
            chartOrderStatistics !== null
          ) {
            const statisticsChart2 = new ApexCharts(
              chartOrderStatistics,
              orderChartConfig
            );
            statisticsChart2.render();
          }
        }
      })
      .catch((error) => console.log(error));
  };

  MostrarDatosCertificaciones();

  // Income Chart - Area chart
  // --------------------------------------------------------------------
  const incomeChartEl = document.querySelector("#incomeChart"),
    incomeChartConfig = {
      series: [
        {
          data: [24, 21, 30, 22, 42, 26, 35, 29],
        },
      ],
      chart: {
        height: 215,
        parentHeightOffset: 0,
        parentWidthOffset: 0,
        toolbar: {
          show: false,
        },
        type: "area",
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 2,
        curve: "smooth",
      },
      legend: {
        show: false,
      },
      markers: {
        size: 6,
        colors: "transparent",
        strokeColors: "transparent",
        strokeWidth: 4,
        discrete: [
          {
            fillColor: config.colors.white,
            seriesIndex: 0,
            dataPointIndex: 7,
            strokeColor: config.colors.primary,
            strokeWidth: 2,
            size: 6,
            radius: 8,
          },
        ],
        hover: {
          size: 7,
        },
      },
      colors: [config.colors.primary],
      fill: {
        type: "gradient",
        gradient: {
          shade: shadeColor,
          shadeIntensity: 0.6,
          opacityFrom: 0.5,
          opacityTo: 0.25,
          stops: [0, 95, 100],
        },
      },
      grid: {
        borderColor: borderColor,
        strokeDashArray: 3,
        padding: {
          top: -20,
          bottom: -8,
          left: -10,
          right: 8,
        },
      },
      xaxis: {
        categories: ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false,
        },
        labels: {
          show: true,
          style: {
            fontSize: "13px",
            colors: axisColor,
          },
        },
      },
      yaxis: {
        labels: {
          show: false,
        },
        min: 10,
        max: 50,
        tickAmount: 4,
      },
    };
  if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
    const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
    incomeChart.render();
  }

  // Expenses Mini Chart - Radial Chart
  // --------------------------------------------------------------------
  const weeklyExpensesEl = document.querySelector("#expensesOfWeek"),
    weeklyExpensesConfig = {
      series: [65],
      chart: {
        width: 60,
        height: 60,
        type: "radialBar",
      },
      plotOptions: {
        radialBar: {
          startAngle: 0,
          endAngle: 360,
          strokeWidth: "8",
          hollow: {
            margin: 2,
            size: "45%",
          },
          track: {
            strokeWidth: "50%",
            background: borderColor,
          },
          dataLabels: {
            show: true,
            name: {
              show: false,
            },
            value: {
              formatter: function (val) {
                return "$" + parseInt(val);
              },
              offsetY: 5,
              color: "#697a8d",
              fontSize: "13px",
              show: true,
            },
          },
        },
      },
      fill: {
        type: "solid",
        colors: config.colors.primary,
      },
      stroke: {
        lineCap: "round",
      },
      grid: {
        padding: {
          top: -10,
          bottom: -15,
          left: -10,
          right: -10,
        },
      },
      states: {
        hover: {
          filter: {
            type: "none",
          },
        },
        active: {
          filter: {
            type: "none",
          },
        },
      },
    };
  if (typeof weeklyExpensesEl !== undefined && weeklyExpensesEl !== null) {
    const weeklyExpenses = new ApexCharts(
      weeklyExpensesEl,
      weeklyExpensesConfig
    );
    weeklyExpenses.render();
  }

  const cargarYears = () => {
    let objdatos = new FormData();
    objdatos.append("cargarYears", "ok");

    fetch(config.rutes["controllerGraficas"], {
      method: "POST",
      body: objdatos,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error;
      })
      .then((response) => {
        let dataSelect = "";
        response.forEach(function (item, index) {
          dataSelect +=
            '<option value="' + item.Year + '">' + item.Year + "</option>";
        });
        $("#selectYear").html(dataSelect);
      });
  };

  cargarYears();

  $("#selectYear").on("change", function () {
    MostrarDatos($(this).val());
    MostrarGrafica($(this).val());
  });
})();
