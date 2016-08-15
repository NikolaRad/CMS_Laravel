@extends('layouts.admin')

@section('charts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Type', 'Total', 'Subscriber/Unapproved/Draft', 'Administrator/Approved/Published'],
                ['Users', {{count($users)}},{{count($authors) + count($subscribers)}} , {{count($administrators)}}],
                ['Posts', {{count($posts)}},{{count($drafted)}} ,{{count($published)}} ],
                ['Comments', {{count($comments)}}, {{count($unapproved)}}, {{count($approved)}}],
                ['Categories', {{count($categories)}}, 0, 0]
            ]);

            var options = {
                chart: {
                    title: 'Live statistics',
                    subtitle: 'Brief look about users, posts, comments and categories represented by numbers.',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, options);
        }
    </script>
@endsection

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{count($users)}}</div>
                            <div>Users</div>
                        </div>
                    </div>
                </div>
                <a href="/admin/users">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{count($posts)}}</div>
                            <div>Posts</div>
                        </div>
                    </div>
                </div>
                <a href="/admin/posts">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{count($comments)}}</div>
                            <div>Comments</div>
                        </div>
                    </div>
                </div>
                <a href="/admin/comments">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{count($categories)}}</div>
                            <div>Categories</div>
                        </div>
                    </div>
                </div>
                <a href="/admin/categories">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="columnchart_material" style="width: 900px; height: 500px;"></div>
        </div>
    </div>
@endsection