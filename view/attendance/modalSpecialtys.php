<style>
    background-color .checkLine:nth-child(1)>i {
        margin-left: 10px;
    }

    .checkline {
        margin-left: 30%;
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
        $('#modalSpecialtys').removeClass('visible');
        $('#modalBarbers').removeClass('visible');
    }

    function getAllSpecialty() {

        new Promise(function(resolve, reject) {
            $.ajax({
                url: "/assets/util/getAllSpecialtys.php",
                type: "GET",
                dataType: "json",
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    // console.log(result);
                    // return resolve(result);
                    createNewItemSpecialtys(response.RESULT);
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
                    <input type="checkbox" value="">
                    <label>Todas</label>
                </div>
                <i class="fa-solid fa-scissors"></i>
            </div>`;
        specialtys.forEach(specialty => {

            item +=
                `<div class="checkLine">
                <div class="ui checkbox">
                    <input type="checkbox" value="${specialty.idSpecialty}">
                    <label>${specialty.nmSpecialty}</label>
                </div>
                <i class="fa-solid fa-scissors"></i>
             </div>`

        });

        listItemSpecialtys.innerHTML = item;

    }
    
</script>