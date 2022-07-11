<style>
    background-color .checkLine:nth-child(1)>i {
        margin-left: 10px;
    }

    #listItemSpecialtys {
        text-align: -webkit-center;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: stretch;
    }

    .checkline {
        margin-left: 30%;
        text-align: -webkit-center;
    }

    .label3 {
        font-size: 2rem !important;
    }

    #card {
        top: 5rem;
    }
</style>


<div class="ui modal" id="modalSpecialtys">
    <i class="close icon" onclick="cancelAttendance()"></i>
    <div class="header">
        Selecione a(s) especialidade(s)
    </div>

    <div class="content" id="listItemSpecialtys"></div>

    <div class="actions">
        <div class="ui black deny button" id="btnCancel" onclick="cancelAttendance()">
            Cancelar
        </div>
        <div class="ui positive right labeled icon button" onclick="advanceToBarberSelection()">
            Avançar
            <i class="checkmark icon"></i>
        </div>
    </div>
</div>

<script>
    function advanceToBarberSelection() {
        var idsSpecialtys = $("#modalSpecialtys input:checked").map(function() {
            return $(this).val();
        }).get();

        getAllBarbersBySpecialty(idsSpecialtys.join(','));
        $('#modalSpecialtys').transition('fade right')
        $('#modalBarbers').transition('fade left')
    }

    function cancelAttendance() {
        $('#modalSpecialtys').transition('fade down')
        $('#modalBarbers').transition('fade down')
        $('#modalAttendance').transition('fade down')
    }

    function getAllSpecialty() {

        new Promise(function(resolve, reject) {
            $.ajax({
                url: "/assets/util/getAllSpecialtys.php",
                type: "POST",
                dataType: "json",
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    createNewItemSpecialtys(response.RESULT);
                    // return resolve(response.STATUS)

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return reject(errorThrown);
                },
            });
        });
    }

    function createNewItemSpecialtys(specialtys = array()) {

        var item =
            `<div class="checkLine">
                <div class="ui checkbox">
                    <input type="checkbox" value="0" onclick="checkAllCheckbox(this)">
                    <label class="label3">Todas</label>
                </div>
                <i class="fa-solid fa-scissors"></i>
            </div>`;
        specialtys.forEach(specialty => {

            item +=
                `<div class="checkLine">
                <div class="ui checkbox">
                    <input type="checkbox" value="${specialty.idSpecialty}">
                    <label class="label3">${specialty.nmSpecialty}</label>
                </div>
                <i class="fa-solid fa-scissors"></i>
             </div>`

        });

        listItemSpecialtys.innerHTML = item;

    }

    function checkAllCheckbox(element) {
        $(element).prop('checked') ? $('#modalSpecialtys input').prop('checked', true) : $('#modalSpecialtys input').prop('checked', false);
    }
</script>