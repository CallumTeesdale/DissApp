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

            if ($array[$key][0] == 'text' || $array[$key][0] == 'textarea') {
                $table = '<div class="table-container"><table id="table' . $counter . '" class="table table-striped table-bordered table-sm" cellspacing="0">
                <thead>
                  <tr>
                  <th class="th-sm">#
                    </th>
                    <th class="th-sm">' . $key . '
                    </th>
                    </tr>
                    </thead>
                    ';

                foreach ($array[$key][1][0] as $content) {


                    $table .= '<tbody>

                            <tr>
                            <td>' . $counter2 . '</td>
                              <td>' . $content[0] . '</td></tr>';
                    $counter2++;
                }
                $table .= '</tbody></div><script>$(document).ready(function () {
                        $(\'#table' . $counter . '\').DataTable();
                        $(\'.dataTables_length\').addClass(\'bs-select\');
                      });</script>';
                array_push($charts, $table);
                $counter2 = 1;
            }
            if ($array[$key][0] == 'select') {
                $labels = [];
                $data = [];
                $merge = [];
                foreach ($array[$key][1][0] as $arr) {
                    array_push($labels, $arr[0]);
                }
                $data = array_count_values($labels);
                $labels = array_unique($labels);
                $numberOfUnique = count($labels);
                $chart = '<div class="chart-container">  <canvas id="myChart' . $counter . '" ></canvas></div>';
                $merge = array_merge(array_flip($labels), $data);

                $string = '';
                foreach ($merge as $key => $value) {
                    $string .= $value . ',';
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
                    } else {
                        $chart  .= '\'' . $labels[$i] . '\'';
                    }
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
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
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