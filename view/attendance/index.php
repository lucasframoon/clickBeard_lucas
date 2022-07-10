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
                                <input type="text" style='text-transform: uppercase' id="barber">
                            </div>
                        </div>

                        <div class="field">
                            <label>Especialidade</label>
                            <div class="ui fluid icon input" style="display: inline-flex">
                                <input type="text" style='text-transform: uppercase' id="specialty">
                            </div>
                        </div>

                        <div class="field">
                            <label>Periodo i</label>
                            <div class="ui fluid icon input" style="display: inline-flex">
                                <input type="text" style='text-transform: uppercase' id="specialty">
                            </div>
                        </div>
                        <div class="field">
                            <label>Periodo f</label>
                            <div class="ui fluid icon input" style="display: inline-flex">
                                <input type="text" style='text-transform: uppercase' id="specialty">
                            </div>
                        </div>

                    </div>

                </form>

                <div class="ui right aligned grid">

                    <div class="right floated sixteen wide column">
                        <div class="ui labeled icon button green" id="btnSearch">Buscar
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

        <!-- <div>
            <label class="ui teal ribbon small label" style="margin-top: 1em;" translation-key="LB_RECORDS">
                <span id="nrRecords">0</span>
            </label>

            <div class="ui raised">
                <div class="ui dimmer" id="loadingTable">
                    <div class="ui text loader" translation-key="LOADING"></div>
                </div>
                <div id="containerMainTable"></div>
            </div>

        </div> -->

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
</script>