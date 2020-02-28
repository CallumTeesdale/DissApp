<?php

namespace app;

class GenerateCharts
{

    public function GenerateCharts($array)
    {
        $charts = [];
        $counter = 0;
        $counter2 = 1;

        foreach ($array as $key => $value) {
            if ($value[0] == 'text' || $value[0]  == 'textarea') {

                $table = '
                <button onclick="myFunction(\'' . $key . '\')" class="g-button block bl">' . $key . '</button>
                <div id="' . $key . '" class="hide accordion-container">
                <div class="table-container"><table id="t' . $counter . '" class="table table-striped table-bordered table-sm" cellspacing="0">
                <thead>
                  <tr>
                  <th class="w-2">#
                    </th>
                    <th class="w-98">' . $key . '
                    </th>
                    </tr>
                    </thead>
                    <tbody>
                    ';

                foreach ($value[1][0] as $content) {


                    $table .= '<tr><td>' . $counter2 . '</td><td>' . $content[0] . '</td></tr>';
                    $counter2++;
                }
                $table .= '</tbody></table></div></div>';
                $table .= '<head><script>$(document).ready(function () {
                    $(\'#t' . $counter . '\').DataTable({
                        "pageLength": 10
                    });
                  });</script></head>';
                array_push($charts, $table);
                $counter2 = 1;
            }
            if ($value[0]  == 'select') {
                $labels = [];
                $data = [];
                $merge = [];
                foreach ($value[1][0] as $arr) {
                    array_push($labels, $arr[0]);
                }
                $data = array_count_values($labels);
                $labels = array_unique($labels);
                $numberOfUnique = count($labels);
                $chart = '<button onclick="myFunction(\'' . $key . '\')" class="g-button block bl">' . $key . '</button>
                <div id="' . $key . '" class="hide accordion-container"><div class="chart-container">  <canvas id="myChart' . $counter . '" ></canvas></div></div>';
                $merge = array_merge(array_flip($labels), $data);

                $string = '';
                foreach ($merge as $mkey => $mvalue) {
                    $string .= $mvalue . ',';
                }


                $chart .= '<script>
                var ctx = document.getElementById(\'myChart' . $counter . '\').getContext(\'2d\');
                var myChart' . $counter . ' = new Chart(ctx, {
                    type: \'pie\',
                    data: {
                        labels: [';

                for ($i = 0; $i < $numberOfUnique; $i++) {
                    if ($i < $numberOfUnique) {
                        $chart  .= '\'' . $labels[$i] . '\',';
                    }
                    // @codeCoverageIgnoreStart
                    else {
                        $chart  .= '\'' . $labels[$i] . '\'';
                    }
                    // @codeCoverageIgnoreStop
                }
                $chart .= '],
                        datasets: [{
                            label: \'' . implode(',', $labels) . '\',
                            data: [' . $string . '],
                            backgroundColor: [
                                \'rgba(255, 99, 132, 0.2)\',
                                \'rgba(54, 162, 235, 0.2)\',
                                \'rgba(255, 206, 86, 0.2)\',
                                \'rgba(75, 192, 192, 0.2)\',
                                \'rgba(153, 102, 255, 0.2)\',
                                \'rgba(255, 159, 64, 0.2)\'
                            ],
                            borderColor: [
                                \'rgba(255, 99, 132, 1)\',
                                \'rgba(54, 162, 235, 1)\',
                                \'rgba(255, 206, 86, 1)\',
                                \'rgba(75, 192, 192, 1)\',
                                \'rgba(153, 102, 255, 1)\',
                                \'rgba(255, 159, 64, 1)\'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {

                        animateRotate: true
                    }
                });
                </script>';
                array_push($charts, $chart);
            }
            if ($value[0]  == 'radio-group') {
                $labels = [];
                $data = [];
                $merge = [];
                foreach ($value[1][0] as $arr) {
                    array_push($labels, $arr[0]);
                }
                $data = array_count_values($labels);
                $labels = array_unique($labels);
                $numberOfUnique = count($labels);
                $chart = '<button onclick="myFunction(\'' . $key . '\')" class="g-button block bl">' . $key . '</button>
                <div id="' . $key . '" class="hide accordion-container"><div class="chart-container">  <canvas id="myChart' . $counter . '" ></canvas></div></div>';
                $merge = array_merge(array_flip($labels), $data);

                $string = '';
                foreach ($merge as $mkey => $mvalue) {
                    $string .= $mvalue . ',';
                }


                $chart .= '<script>
                var ctx = document.getElementById(\'myChart' . $counter . '\').getContext(\'2d\');
                var myChart' . $counter . ' = new Chart(ctx, {
                    type: \'pie\',
                    data: {
                        labels: [';

                for ($i = 0; $i < $numberOfUnique; $i++) {
                    if ($i < $numberOfUnique) {
                        $chart  .= '\'' . $labels[$i] . '\',';
                    }
                    // @codeCoverageIgnoreStart
                    else {
                        $chart  .= '\'' . $labels[$i] . '\'';
                    }
                    // @codeCoverageIgnoreStop
                }
                $chart .= '],
                        datasets: [{
                            label: \'' . implode(',', $labels) . '\',
                            data: [' . $string . '],
                            backgroundColor: [
                                \'rgba(255, 99, 132, 0.2)\',
                                \'rgba(54, 162, 235, 0.2)\',
                                \'rgba(255, 206, 86, 0.2)\',
                                \'rgba(75, 192, 192, 0.2)\',
                                \'rgba(153, 102, 255, 0.2)\',
                                \'rgba(255, 159, 64, 0.2)\'
                            ],
                            borderColor: [
                                \'rgba(255, 99, 132, 1)\',
                                \'rgba(54, 162, 235, 1)\',
                                \'rgba(255, 206, 86, 1)\',
                                \'rgba(75, 192, 192, 1)\',
                                \'rgba(153, 102, 255, 1)\',
                                \'rgba(255, 159, 64, 1)\'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {

                        animateRotate: true
                    }
                });
                </script>';
                array_push($charts, $chart);
            }
            if ($value[0]  == 'checkbox-group') {
                $labels = [];
                $data = [];
                $string = '';
                foreach ($value[1][0] as $s) {
                    for ($i = 0; $i < count($s); $i++) {
                        if ($i < (count($s) - 1)) {
                            $string .= $s[$i] . ' + ';
                        } else {
                            $string .= $s[$i];
                        }
                    }
                    if (!in_array($string, $labels)) {
                        array_push($labels, $string);
                    }
                    $string = '';
                }
                $numberOfUnique = count($labels);
                $flippedLabels = array_flip($labels);
                $flippedLabels = array_fill_keys(array_keys($flippedLabels), 0);
                $data = [];
                $string = '';
                foreach ($value[1][0] as $s) {
                    for ($i = 0; $i < count($s); $i++) {
                        if ($i < (count($s) - 1)) {
                            $string .= $s[$i] . ' + ';
                        } else {
                            $string .= $s[$i];
                        }
                    }
                    if (array_key_exists($string, $flippedLabels)) {
                        $flippedLabels[$string]++;
                    }
                    $string = '';
                }


                $chart = '<button onclick="myFunction(\'' . $key . '\')" class="g-button block bl">' . $key . '</button>
                <div id="' . $key . '" class="hide accordion-container"><div class="chart-container">  <canvas id="myChart' . $counter . '" ></canvas></div></div>';

                $chart .= '<script>
                var ctx = document.getElementById(\'myChart' . $counter . '\').getContext(\'2d\');
                var myChart' . $counter . ' = new Chart(ctx, {
                    type: \'bar\',
                    data: {
                        labels: [';

                for ($i = 0; $i < $numberOfUnique; $i++) {
                    if ($i < $numberOfUnique) {
                        $chart  .= '\'' . $labels[$i] . '\',';
                    }
                    // @codeCoverageIgnoreStart
                    else {
                        $chart  .= '\'' . $labels[$i] . '\'';
                    }
                    // @codeCoverageIgnoreStop
                }
                $chart .= '],
                        datasets: [{
                            label: \'' . $key . '\',
                            data: [' . implode(',', array_values($flippedLabels)) . '],
                            minBarLength: 0,
                            backgroundColor: [
                                \'rgba(255, 99, 132, 0.2)\',
                                \'rgba(54, 162, 235, 0.2)\',
                                \'rgba(255, 206, 86, 0.2)\',
                                \'rgba(75, 192, 192, 0.2)\',
                                \'rgba(153, 102, 255, 0.2)\',
                                \'rgba(255, 159, 64, 0.2)\'
                            ],
                            borderColor: [
                                \'rgba(255, 99, 132, 1)\',
                                \'rgba(54, 162, 235, 1)\',
                                \'rgba(255, 206, 86, 1)\',
                                \'rgba(75, 192, 192, 1)\',
                                \'rgba(153, 102, 255, 1)\',
                                \'rgba(255, 159, 64, 1)\'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                          display: true
                        },
                        scales: {
                          xAxes: [{
                            display: true,
                            ticks: {
                              min: 0
                            }
                          }],
                          yAxes: [{
                            display: true,
                            ticks: {
                                min: 0
                              }
                          }],
                        }
                      }
                });
                </script>';
                array_push($charts, $chart);
            }
            $counter++;
        }
        return $charts;
    }
}