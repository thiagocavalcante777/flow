$(function () {

    populateTable();

    var rows;
    var count = 0;

    function populateTable(){
        var table = $(".table-monitor tbody");
        var tableRows = $(".table-monitor tr");
        tableRows.remove();


        $.ajax({
            type: "GET",
            url: '/monitor-times-tasks',
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
            success: function (result) {

                rows = result.length;

                $('#rowsTotal').val(rows);

                $.each(result,function(index, elem){
                    const startTimeDateTime = elem.startTime ? elem.startTime : '';
                    const endTimeDateTime = elem.endTime ? elem.endTime : '';
                    const totalDateTime = elem.total ? formatHourMinute(elem.total) : elem.total;
                    const totalTimeServiceDateTime = elem.totalTimeService ?
                        formatHourMinute(elem.totalTimeService) : '';

                    const status = getStatusTimeTask(elem.status)

                    const backgroundColor = getStatusColorTimeTask(elem.status)

                    table.append(
                        "<tr class='row-monitor'>" +
                        "<td style='width: 5%;text-align: center'>"+elem.id+"</td>" +
                        "<td style='width: 10%;text-align: center'>"+elem.collaboratorName+"</td>   " +
                        "<td style='width: 15%;text-align: center'>"+elem.projectReference+"</td>" +
                        "<td style='width: 20%;text-align: center'>"+elem.modelTidDesignation+"</td>" +
                        "<td style='width: 10%;text-align: center'>"+startTimeDateTime+"</td>" +
                        "<td style='width: 10%;text-align: center'>"+endTimeDateTime+"</td>" +
                        "<td style='width: 10%;text-align: center'>"+totalDateTime+"</td>" +
                        "<td style='width: 10%;text-align: center'>"+totalTimeServiceDateTime+"</td>" +
                        "<td class='status-row-monitor' style='width: 10%;text-align: center'>"+status+"</td>" +
                        "</tr>"
                    );
                });
            },
            error: function (xhr, status, err) {
                alert(err.toString(), 'Error - LoadListItemsHelper');
            }
        });
    }


        function getStatusTimeTask(status) {

            if (status === 'O') {
                return 'Em Andamento'
            }

            if (status === 'C') {
                return 'Fechada'
            }

            if (status === 'S') {
                return 'Fechada'
            }
        }

        function getStatusColorTimeTask(status) {
            if (status === 'O') {
                return '#212121'
            }

            if (status === 'C') {
                return '#1a237e'
            }

            if (status == 'S') {
                return '#42a5f5'
            }

            return '#212121'
        }

    var scrollHandler = null;

    function autoScroll () {
        clearInterval(scrollHandler);
        scrollHandler = setInterval(function() {
            var nextScroll = $(window).scrollTop() + 20;
            $(window).scrollTop(nextScroll);
        },2000);
    }

    $(window).scroll(function() {

        count +=1;

        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop() + 10;

        if (scrollPosition > scrollHeight) {
            populateTable();
        }

        // Stop interval after user scrolls
        clearInterval(scrollHandler);
        // Wait 2 seconds and then start auto scroll again
        // Or comment out this line if you don't want to autoscroll after the user has scrolled once
        setTimeout(autoScroll, 200);
    });

    autoScroll();

    setTimeout(function () {

        if (count < 1) {
         setInterval(function () {
             populateTable();
         },25000)
        }
    },10000)

 });

function formatZeroLeftTwoHouseNumbers(num) {
    size = 2
    num = num.toString()
    while (num.length < size) num = "0" + num
    return num
}

function formatHourMinute(hourMinute) {
    strSplit = hourMinute.split(':')

    for(var i = 0; i < strSplit.length; i++){
        strSplit[i] = formatZeroLeftTwoHouseNumbers(strSplit[i])
    }

    return strSplit[0]+':'+strSplit[1]
}

