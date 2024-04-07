$(function () {
    $('#btn-cancel').attr("disabled", false);

    $('#btn-cancel').on('click',function (e) {
        e.preventDefault()
        clearBarCodeFormInputs()
        displayNoneCancelElements()
        displayToBeginElements()
        $( "#barCodeInput" ).focus();
        var flashClass = "alert-request-processed";
        var flash = $("." + flashClass);
        flash.html("Ação Cancelada com Sucesso!")
        flash.append(' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>')
        $('.alert-request-processed').removeClass('alert-warning')
        $('.alert-request-processed').addClass('alert-success')
        $('.alert-request-processed').show();
        $('.final-btn').hide();
        $('#btn-cancel').hide();
    })

    $('#btn-leave-free').on('click', function (e) {
        e.preventDefault()
        clearBarCodeFormInputs()
        displayNoneCancelElements()
        var flashClass = "alert-request-processed";
        var flash = $("." + flashClass);
        flash.html("Terminal Livre!")
        flash.append(' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>')
        $('.alert-request-processed').removeClass('alert-warning')
        $('.alert-request-processed').addClass('alert-success')
        $('.alert-request-processed').show();
        $('#btn-leave-free').hide()
    })

    $('#btn-close-alert-request-processed').on('click',function () {
        e.preventDefault()
        $('.alert-request-processed').hide()
    })

    $( "#barCodeInput" ).focus();

    let enterEnabled = true;

    $("#barCodeInput").keypress(function (event) {

        if (event.keyCode == 13 && enterEnabled) {

            event.preventDefault();
            var form = $(this);
            var action = $(".form-barcode").attr("action");
            var load = $(".ajax_load");
            var flashClass = "alert-request-processed";
            var flash = $("." + flashClass);
            var dataTimeTask = {
               "timeTask" : {
                   "id" : $('#timeTask_id').val() ? parseInt($('#timeTask_id').val()) : 0,
                   "totalTime" : $('#totalTime').val() ? $('#totalTime').val() : null,
                   "startTimeTask" : $('#startTimeTask').val() ? $('#startTimeTask').val() : null,
                   "endTimeTask" : $('#endTimeTask').val() ? $('#endTimeTask').val() : null,
                   "collaborator": {
                       "collaboratorId":$('#collaboratorId').val(),
                       "systemUserId":$('#systemUserId').val(),
                       "name": $('#collaboratorName').val()
                   },
                   "project": {
                       "projectId":$('#projectId').val(),
                       "reference":$('#projectReference').val(),
                       "designation":$('#projectDesignation').val(),
                   },
                   "modelTask": {
                       "modelTaskId":$('#modelTaskId').val(),
                       "designation":$('#modelTaskDesignation').val(),
                   }
               },
               "barCodeInput": $( '#barCodeInput').val()
            };

            form.ajaxSubmit({
                url: action,
                type: "POST",
                data: dataTimeTask,
                dataType: "json",
                processData: false,
                beforeSend: function () {
                    enterEnabled = false;
                    load.fadeIn(200).css("display", "flex");
                },
                success: function (response) {

                    load.fadeOut(200);

                    if (response.message) {
                        flash.html(response.message)
                        if (response.typeMessage == 'warning') {
                            $('.alert-request-processed').removeClass('alert-success')
                            $('.alert-request-processed').addClass('alert-warning')
                        }

                        if (response.typeMessage == 'success') {
                            $('.alert-request-processed').addClass('alert-success')
                            $('.alert-request-processed').removeClass('alert-warning')
                        }

                        $('.alert-request-processed').show();
                    }

                    if (response.isOld == true) {
                        $('#totalTimeLabel').show()
                        $('#startTimeTaskLabel').show()
                        $('#endTimeTaskLabel').show()
                        $('#totalTime').show()
                        $('#startTimeTask').show()
                        $('#endTimeTask').show()
                        $('.time-task-review').show()
                        $('.final-btn').show()
                        $('.final-btn').addClass('close-task')
                        $('.final-btn').removeClass('open-task')
                        $('.final-btn').html("FINALIZAR TAREFA")
                        $('#btn-cancel').show();
                        displayNoneToCloseTaskElements()
                    }else{
                        $('#btn-leave-free').hide()
                    }

                    console.log(response)


                    if (response.timeTask.id != null) {
                        dataTimeTask.timeTask.id = response.timeTask.id;
                    }

                    if (response.timeTask.collaborator.id != null) {
                        dataTimeTask.timeTask.collaborator = response.timeTask.collaborator
                    }

                    if (response.timeTask.project.id != null) {
                        dataTimeTask.timeTask.project = response.timeTask.project
                    }

                    if (response.timeTask.modelTask.id != null) {
                        dataTimeTask.timeTask.modelTask = response.timeTask.modelTask
                    }

                    if (response.timeTask.startTime != null) {
                        dataTimeTask.timeTask.startTime = formatDateTimePTBR(new Date(response.timeTask.startTime))
                    }

                    if (response.timeTask.endTime != null) {
                        dataTimeTask.timeTask.endTime = formatDateTimePTBR(new Date(response.timeTask.endTime))
                    }

                    if (response.timeTask.totalTime != null) {
                        dataTimeTask.timeTask.totalTime = formatHourMinute(response.timeTask.totalTime)
                    }

                    /*set in form*/
                    if ( dataTimeTask.timeTask.id != null) {
                        $('#timeTask_id').val(dataTimeTask.timeTask.id)
                        $('#startTimeTask').val(dataTimeTask.timeTask.startTime)
                        $('#endTimeTask').val(dataTimeTask.timeTask.endTime)
                        $('#totalTime').val(dataTimeTask.timeTask.totalTime)
                        $('#totalTimeService').val(dataTimeTask.timeTask.totalTimeService)
                    }


                    if (dataTimeTask.timeTask.collaborator.id != null) {
                        $( '#collaborator_id').val(dataTimeTask.timeTask.collaborator.id);
                        $( '#systemUserId').val(dataTimeTask.timeTask.collaborator.systemUserId);
                        $( '#collaboratorId').val(dataTimeTask.timeTask.collaborator.collaboratorId);
                        $( '#collaboratorName').val(dataTimeTask.timeTask.collaborator.name);
                    }

                    if (dataTimeTask.timeTask.project.id != null) {
                        $( '#project_id').val(dataTimeTask.timeTask.project.id);
                        $( '#projectId').val(dataTimeTask.timeTask.project.projectId);
                        $( '#projectReference').val(dataTimeTask.timeTask.project.reference);
                    }

                    if (dataTimeTask.timeTask.modelTask.id != null) {
                        $( '#modelTaskId').val(dataTimeTask.timeTask.modelTask.modelTaskId);
                        $( '#modelTaskDesignation').val(dataTimeTask.timeTask.modelTask.designation);
                    }

                    if (
                        !dataTimeTask.timeTask.id &&
                        dataTimeTask.timeTask.collaborator.id &&
                        dataTimeTask.timeTask.project.id &&
                        dataTimeTask.timeTask.modelTask.id
                    ) {
                        $('.final-btn').show()
                        $('.final-btn').addClass('open-task')
                        $('.final-btn').removeClass('close-task')
                        $('.final-btn').html("Começar Tarefa")
                        $('.final-btn').attr('active')
                        $('#btn-cancel').show();
                    }

                    if (
                        dataTimeTask.timeTask.id &&
                        dataTimeTask.timeTask.collaborator.id &&
                        dataTimeTask.timeTask.project.id &&
                        dataTimeTask.timeTask.modelTask.id &&
                        response.isOld != true
                    ) {
                        $('#totalTimeLabel').show()
                        $('#startTimeTaskLabel').show()
                        $('#endTimeTaskLabel').show()
                        $('#totalTime').show()
                        $('#startTimeTask').show()
                        $('#endTimeTask').show()
                        $('.time-task-review').show()
                        $('.final-btn').show()
                        $('.final-btn').addClass('close-task')
                        $('.final-btn').removeClass('open-task')
                        $('.final-btn').html("Fechar Tarefa")
                        $('#btn-cancel').show();
                        flash.html("TAREFA EM ANDAMENTO")
                        flash.append(' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>')
                        $('.alert-request-processed').removeClass('alert-success')
                        $('.alert-request-processed').addClass('alert-warning')
                        $('.alert-request-processed').html()
                        $('.alert-request-processed').show();
                        displayNoneToCloseTaskElements()
                    }
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        load.fadeOut(200);
                    }
                },
                complete: function () {
                    if (form.data("reset") === true) {
                        form.trigger("reset");
                    }
                    $( '#barCodeInput').val('');
                    $( "#barCodeInput" ).focus();
                    enterEnabled = true;
                }
            });
        }
    });

    let isRequestPending = false;

    $("#finalButton").on('click',function (e) {

        if (!isRequestPending) {
            e.preventDefault();

            var form = $('.form-barcode')
            var load = $(".ajax_load");
            var flashClass = "alert-request-processed";
            var flash = $("." + flashClass);

            var dataTimeTaskFinishing = {
                "timeTask" : {
                    "id" : $('#timeTask_id').val() ? parseInt($('#timeTask_id').val()) : 0,
                    "totalTime" : $('#totalTime').val() ? $('#totalTime').val() : null,
                    "startTimeTask" : $('#startTimeTask').val() ? $('#startTimeTask').val() : null,
                    "endTimeTask" : $('#endTimeTask').val() ? $('#endTimeTask').val() : null,
                    "endTime" : $('#endTimeTask').val() ? formatDateTimePTBRToEng($('#endTimeTask').val()) : null,
                    "collaborator": {
                        "collaboratorId":$('#collaboratorId').val(),
                        "name": $('#collaboratorName').val()
                    },
                    "project": {
                        "projectId":$('#projectId').val(),
                        "reference":$('#projectReference').val(),
                        "designation":$('#projectDesignation').val(),
                    },
                    "modelTask": {
                        "modelTaskId":$('#modelTaskId').val(),
                        "designation":$('#modelTaskDesignation').val(),
                    }
                },
                "barCodeInput": $( '#barCodeInput').val()
            };

            var dataTimeTaskStart = {
                "timeTask" : {
                    "id" : $('#timeTask_id').val() ? parseInt($('#timeTask_id').val()) : 0,
                    "collaborator": {
                        "collaboratorId":$('#collaboratorId').val(),
                        "name": $('#collaboratorName').val()
                    },
                    "project": {
                        "projectId":$('#projectId').val(),
                        "reference":$('#projectReference').val(),
                        "designation":$('#projectDesignation').val(),
                    },
                    "modelTask": {
                        "modelTaskId":$('#modelTaskId').val(),
                        "designation":$('#modelTaskDesignation').val(),
                    }
                },
                "barCodeInput": $( '#barCodeInput').val()
            };

            form.ajaxSubmit({
                url: 'finally-process',
                type: "POST",
                data: dataTimeTaskStart.timeTask.id != 0 ? dataTimeTaskFinishing : dataTimeTaskStart,
                dataType: "json",
                processData: false,
                beforeSend: function () {
                    isRequestPending = true;
                    console.log(form.serialize());
                    load.fadeIn(200).css("display", "flex");
                },
                success: function (response) {
                    //redirect
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        load.fadeOut(200);
                    }

                    if (response.message) {
                        flash.html(response.message)

                        if (response.typeMessage == 'warning') {
                            $('.alert-request-processed').removeClass('alert-success')
                            $('.alert-request-processed').addClass('alert-warning')
                        }

                        if (response.typeMessage == 'success') {
                            $('.alert-request-processed').addClass('alert-success')
                            $('.alert-request-processed').removeClass('alert-warning')
                        }

                        $('.alert-request-processed').show();
                        flash.fadeOut(15000);
                    }

                },
                complete: function () {
                    clearBarCodeFormInputs();
                    displayNoneToBeginElemts()
                    displayToBeginElements()
                    $('.final-btn').hide();
                    $('#btn-cancel').hide();
                    $( "#barCodeInput" ).focus();
                    $('.alert-validation-time-task').hide()
                    isRequestPending = false;
                }
            });
        }

    });

    function clearBarCodeFormInputs() {
        $('#collaboratorId').val('');
        $('#collaboratorName').val('');
        $('#barCodeInput').val('');
        $('#projectId').val(''),
        $('#projectReference').val(''),
        $('#projectDesignation').val('');
        $('#modelTaskId').val('');
        $('#modelTaskDesignation').val('');
        $('#totalTime').val('');
        $('#startTimeTask').val('');
        $('#endTimeTask').val('');
    }

    function clearDetailsInput() {

    }

    function displayNoneCancelElements() {
        $('.time-task-review ').css("display","none")
    }

    function displayNoneToCloseTaskElements() {
        $('#barCodeArea').css('display', 'none')
    }

    function displayToBeginElements() {
        $('#barCodeArea').slideDown(400).css('display', 'block')
    }

    function displayNoneToBeginElemts() {
        $('.time-task-review ').css("display","none")
    }

    function formatDateTimePTBR(DateTimeObject) {
        DateTimeObject.toISOString();
        let day = formatZeroLeftTwoHouseNumbers(DateTimeObject.getUTCDate())
        let month = formatZeroLeftTwoHouseNumbers(DateTimeObject.getMonth() < 12 ? DateTimeObject.getMonth() + 1: 1 )
        let year = DateTimeObject.getFullYear()
        let hour = formatZeroLeftTwoHouseNumbers(DateTimeObject.getHours())
        let minute = formatZeroLeftTwoHouseNumbers(DateTimeObject.getMinutes())

        return day+'/'+month+'/'+year+' '+hour+':'+minute
    }

    function formatDateTimePTBRToEng(dateString) {
        let DateTimeSplit = dateString.split(' ')
        let onlyDate = DateTimeSplit[0]
        let onlyDateSplit = onlyDate.split('/')
        let newOnlyDate = onlyDateSplit[2]+'-'+onlyDateSplit[1]+'-'+onlyDateSplit[0]
        let onlyTime = DateTimeSplit[1]
        let newOnlyTimeTime = onlyTime+':00'

        let newDateTimeFormated = newOnlyDate+' '+newOnlyTimeTime

        return newDateTimeFormated
    }

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

    $('.form-rectify').submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var action = $(".form-rectify").attr("action");
        var load = $(".ajax_load");
        var flashClass = "alert-request-processed";
        var flash = $("." + flashClass);
        var dataTimeTask = {
            "timeTask" : {
                "id" : $('#timeTask_id').val() ? parseInt($('#timeTask_id').val()) : 0,
                "startTimeTask" : $('#startTimeTask').val(),
                "endTimeTask" : $('#endTimeTask').val(),
                "collaborator": {
                    "id":$('#collaborator_id').val(),
                    "collaboratorId":$('#collaboratorId').val(),
                    "systemUserId":$('#systemUserId').val(),
                    "name": $('#collaboratorName').val()
                },
                "project": {
                    "id":$('#project_id').val(),
                    "projectId":$('#projectId').val(),
                    "reference":$('#projectReference').val(),
                    "designation":$('#projectDesignation').val(),
                },
                "modelTask": {
                    "modelTask":$('#modelTask').val(),
                    "designation":$('#modelTaskDesignation').val(),
                }
            }
        };

        form.ajaxSubmit({
            url: action,
            type: "POST",
            data: dataTimeTask,
            dataType: "json",
            processData: false,
            beforeSend: function () {
                console.log(form.serialize());
                load.fadeIn(200).css("display", "flex");
            },
            success: function (response) {

                if (response.message) {
                    load.fadeOut(200);
                    flash.html(response.message)
                    $('.alert-request-processed').addClass('alert-success')
                    $('.alert-request-processed').removeClass('alert-warning')
                    $('.alert-request-processed').show();
                    flash.fadeOut(15000);
                }

                if (response.redirect) {
                    setTimeout(function () {
                        window.location.href = response.redirect;
                    },3000)

                } else {
                    load.fadeOut(200);
                }

            }
        });
    })
  });
