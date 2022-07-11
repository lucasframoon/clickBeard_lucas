<?php
include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/assets/includes/header.php');
?>

<div class="ui container">

    <div id="globalDimmer" class="ui dimmer">
        <div class="ui text loader" translation-key="LOADING"></div>
    </div>

    <section id="content">
        <p class="ui teal big ribbon label" style="margin-bottom: 12px">Consulta</p>
        <div class="ui styled fluid accordion" id="filters">
            <div class="ui dimmer" id="dimmer">
                <div class="ui text loader">
                    <h3>Carregando</h3>
                </div>
            </div>

            <div class="active content">

                <form class="ui form" id="formSearch">
                    <div class="equal width fields">

                        <div class="field">
                            <label>Barbeiro</label>
                            <div class="ui fluid icon input" style="display: inline-flex">
                                <input type="text" style='text-transform: uppercase' id="nmBarber">
                            </div>
                        </div>

                        <div class="field">
                            <label>Especialidade</label>
                            <div class="ui fluid icon input" style="display: inline-flex">
                                <input type="text" style='text-transform: uppercase' id="nmSpecialty">
                            </div>
                        </div>

                        <div class="field">
                            <label>Data inicial</label>
                            <div class="ui fluid icon input" style="display: inline-flex">
                                <input type="text" style='text-transform: uppercase' id="dtInitial">
                            </div>
                        </div>
                        <div class="field">
                            <label>Data final</label>
                            <div class="ui fluid icon input" style="display: inline-flex">
                                <input type="text" style='text-transform: uppercase' id="dtFinal">
                            </div>
                        </div>

                    </div>

                </form>

                <div class="ui right aligned grid">

                    <div class="right floated sixteen wide column">
                        <div class="ui labeled icon button green" id="btnSearch" onclick="getAttendancesByWhere()">Buscar
                            <i class="search icon"></i>
                        </div>
                        <!-- <div class="ui labeled icon button blue" id="btnNew" onclick="$('#modalDateAttendance').transition('fade up')">Novo -->
                        <div class="ui labeled icon button blue" id="btnNew" onclick="$('#modalSpecialtys').transition('fade up')">Novo
                            <i class="plus icon"></i>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <table class="ui celled table">
            <thead>
                <tr>
                    <th>Profissional</th>
                    <th>Serviço</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th style="width: 8rem;">Ação</th>
                </tr>
            </thead>
            <tbody id="attendanceTbody">

            </tbody>
        </table>

    </section>
    <?php
    include_once('modalBarbers.php');
    include_once('modalSpecialtys.php');
    include_once('modalAttendance.php');
    ?>

</div>
<?php include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/assets/includes/footer.php'); ?>

<script>
    $(document).ready(function() {
        getAllSpecialty();
        $('#ckAllSpecialtys').change(function() {

            if ($('#ckAllSpecialtys').prop("checked")) {
                $('.checkLine input').prop('checked', 'true');
            } else {
                $('.checkLine input').prop('checked', '');
            }
        });

        $('#btnCancel').click(function() {
            $('#modalSpecialtys').hide();
        });

        $('#btnNext').click(function() {
            $('#modalSpecialtys').transition('fly right')
            setTimeout(() => {
                $('#modalBarbers').transition('fly left')
            }, 5);
        });
    });

    function getAttendancesByWhere() {
        $('#globalDimmer').show();

        data = new FormData();
        data.append('nmBarber', $('#nmBarber').val());
        data.append('nmSpecialty', $('#nmSpecialty').val());
        data.append('dtInitial', $('#dtInitial').val());
        data.append('dtFinal', $('#dtFinal').val());

        new Promise(function(resolve, reject) {
            $.ajax({
                url: "./control/getAttendancesByWhere.php",
                type: "POST",
                data: data,
                dataType: "json",
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response.STATUS == 'OK') {
                        // console.log(response.RESULT);
                        createTableRows(response.RESULT);
                    } else {
                        alert(response.STATUS);
                    }
                    // return resolve(response.STATUS)
                    $('#globalDimmer').hide();

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#globalDimmer').hide();
                    return reject(errorThrown);

                },
            });
        });
    }

    function createTableRows(attendances = []) {
        rows = '';


        attendances.forEach(attendance => {
            dateAndTime = extractDateAndTime(attendance.dtAttendance);
            rows += `<tr>
                        <td>
                            <h4 class="ui image header">
                                <img src=${attendance.barber.dsImagePath} class="ui mini rounded image">
                                <div class="content">${attendance.barber.nmBarber}</div>
                            </h4>
                        </td>
                        <td data-label="nmSpecialty">${attendance.specialty.nmSpecialty}</td>
                        <td data-label="dtAttendance">${dateAndTime[0]}</td>
                        <td data-label="hrAttendance">${dateAndTime[1]}</td>
                        <td data-label="btnCancel">
                            <div class="ui basic red button" onclick="cancelAttendance(${attendance.idAttendance, attendance.dtAttendance})">Cancelar</div>
                        </td>
                    </tr>`;
        });

        $('#attendanceTbody').html(rows);
    }

    function extractDateAndTime(dtAttendance = '') {

        if (dtAttendance == '') {
            return '';
        }

        dtAttendanceSplit = dtAttendance.split(' ');
        dateSplit = dtAttendanceSplit[0].split('-');
        date = dateSplit[2] + '/' + dateSplit[1] + '/' + dateSplit[0];

        time = '';
        time = dtAttendanceSplit[1].substring(0, 5);

        return [date, time];
    }

    function cancelAttendance(idAttendance = '', dtAttendance = '') {

        if (idAttendance == '' || dtAttendance == '') {
            return;
        }

        now = new Date();

        dtAttendance = new Date(dtAttendance);

        if (now.getTime() - dtAttendance.getTime() > (1000 * 60 * 60 * 24)) {
            alert('Não é possível cancelar uma atendimento que tenha passado.');
            return;
        }else if(now.getTime() - dtAttendance.getTime() > (1000 * 60 * 60 * 2)){
            alert('Não é possível cancelar uma atendimento com menos de 2 horas antes do horário marcado.');
            return;
        }

        //calculate if the attendance is in 2 hours or less


        $('#globalDimmer').show();
        data = new FormData();
        data.append('idAttendance', idAttendance);
        data.append('nmBarber', nmBarber);
        new Promise(function(resolve, reject) {
            $.ajax({
                url: "./control/cancelAttendance.php",
                type: "POST",
                data: data,
                dataType: "json",
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response.STATUS == 'OK') {
                        // console.log(response.RESULT);
                        getAttendancesByWhere();
                    } else {
                        alert(response.STATUS);
                    }
                    // return resolve(response.STATUS)
                    $('#globalDimmer').hide();

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#globalDimmer').hide();
                    return reject(errorThrown);

                },
            });
        });

    }
</script>