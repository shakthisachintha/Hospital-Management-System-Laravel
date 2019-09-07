@extends('template.main')

@section('title', $title)

@section('sidebar')

<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Main Menu</li>
    <!-- Optionally, you can add icons to the links -->
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i><span> Dashboard</span></a></li>
{{--patient--}}
    <li class="treeview">
        <a href="#"><i class="fas fa-user-injured"></i><span> Patient</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('patient')}}"></i><i class="fas fa-user-plus" aria-hidden="true"></i> Register New</a></li>
            <li><a href="#"></i><i class="fas fa-id-card" aria-hidden="true"></i> Search Patient</a></li>
        </ul>
    </li>
{{--create channel--}}
    <li><a href="{{route('create_channel_view')}}"><i class="fas fa-folder-plus"></i><span> Create Channel</span></a></li>
{{--check patient--}}
    <li><a href="{{route('check_patient_view')}}"><i class="fas fa-procedures"></i><span> Check Patient</span></a></li>
    <li class="treeview active">
        <a href="#"><i class="fas fa-calendar-check"></i></i><span> Attendance</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        <li class="active"><a href="{{route('myattend')}}"><i class="fas fa-calendar-day" aria-hidden="true"></i> My Attendance</a></li>
            <li><a href="{{route('attendmore')}}"><i class="fas fa-plus-square" aria-hidden="true"></i> More</a></li>
        </ul>
    </li>

     {{-- Users Operations --}}

     <li class="treeview">
        <a href="#"><i class="fas fa-users-cog"></i><span> Users</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('newuser')}}">  <i class="fa fa-user-plus" aria-hidden="true"></i>New User</a></li>
            <li><a href="{{route('regfinger')}}"><i class="fa fa-fingerprint" aria-hidden="true"></i>Register Fingerprint</a></li>
            <li><a href="{{route('resetuser')}}"><i class="fa fa-user-edit" aria-hidden="true"></i>Reset User</a></li>
        </ul>
    </li>

    {{-- Profile --}}

<li><a href="{{route('profile')}}"><i class="fas fa-user"></i><span> Profile</span></a></li>
</ul>

@endsection

@section('content_title',"My Attendance")
@section('content_description',"My Attendance And Holidays Taken")
@section('breadcrumbs')

<ol class="breadcrumb">
    <li><a href="{{route('dash')}}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
    <li class="active">Here</li>
</ol>
@endsection

@section('main_content')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["calendar"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn({
            type: 'date',
            id: 'Date'
        });
        dataTable.addColumn({
            type: 'number',
            id: 'Worked Hours'
        });
        dataTable.addRows([
            [new Date(2012, 3, 13), -1],
            [new Date(2012, 3, 14), 1],
            [new Date(2012, 3, 15), 0],
            [new Date(2012, 3, 16), 1],
            [new Date(2012, 3, 17), 2],
            // Many rows omitted for brevity.
            [new Date(2013, 9, 4), 3],
            [new Date(2013, 9, 5), 3],
            [new Date(2013, 9, 12), 3],
            [new Date(2013, 9, 13), 3],
            [new Date(2013, 9, 19), 3],
            [new Date(2013, 9, 23), 3],
            [new Date(2013, 9, 24), 3],
            [new Date(2013, 9, 30), 3],

            [new Date(2014, 3, 30), 0],
            [new Date(2014, 4, 30), 0],
            [new Date(2014, 5, 30), 0],
            [new Date(2014, 6, 30), 0],
            [new Date(2014, 7, 30), 0],
            [new Date(2014, 8, 30), 0],
            [new Date(2014, 9, 30), 0],
            [new Date(2014, 10, 30), 0],
        ]);

        var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

        var options = {
            calendar: {
                cellSize: 20,
                dayOfWeekLabel: {
                    fontName: 'Times-Roman',
                    fontSize: 12,
                    color: 'black',
                    bold: false,
                    italic: false
                },
                monthOutlineColor: {
                    stroke: 'black',
                    strokeOpacity: 0.7,
                    strokeWidth: 2
                },
                noDataPattern: {
                    backgroundColor: '#76a7ff',
                    color: '#76a7fa'
                },
                unusedMonthOutlineColor: {
                    stroke: 'gray',
                    strokeOpacity: 0.8,
                    strokeWidth: 2
                }
            },
            title: "Attendance",
            colorAxis: {
                colors: ['#f25555', '#edf255', '#55b6f2', '#55f27f'],
                // colors: ['present', 'halfday','holliday','absent'],
                maxValue: 10,
                minValue: 0,
                values: [0, 4, 7, 10]

            }
        };

        chart.draw(dataTable, options);
    }

</script>
<div id="calendar_basic" style="height:700px"></div>
@endsection
