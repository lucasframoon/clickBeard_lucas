<div class="ui modal" id="modalBarbers">
    <i class="close icon"></i>
    <div class="header">
        Selecione o profissional
    </div>

    <div class="content" id="contentBarbers" style="display: flex; flex-direction: row; justify-content: space-around; align-items: center;">

        <div class="image content">
            <img class="image" src="https://semantic-ui.com/images/wireframe/square-image.png" alt="">
        </div>

        <div class="ui middle aligned divided list" id="listItemBarbers"></div>

    </div>

    <div class="actions">
        <div class="ui black deny button" id="btnReturnToSpecialtys" onclick="returnToSpecialtys()">
            Voltar
        </div>
        <div class="ui positive right labeled icon button" onclick="advanceToAttendance()">
            Avançar
            <i class="checkmark icon"></i>
        </div>
    </div>
</div>

<script>
    function changePhoto(imgPath, idBarber) {
        $('#modalBarbers .image img').attr('src', imgPath);
        $('#modalBarbers .image img').attr('id', idBarber);

    }

    function returnToSpecialtys() {
        $('#modalBarbers').transition('fade left')
        $('#modalSpecialtys').transition('fade right')
    }

    function getAllBarbersBySpecialty(idsSpecialtys = null) {

        if (idsSpecialtys == null) {
            return false;
        }

        ids = new FormData();
        ids.append('ids', idsSpecialtys);

        new Promise(function(resolve, reject) {
            $.ajax({
                url: "/assets/util/getAllBarbersBySpecialty.php",
                type: "POST",
                data: ids,
                dataType: "json",
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    createNewItemBarbers(response.RESULT);
                    // return resolve(response.STATUS)

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return reject(errorThrown);
                },
            });
        });
    }

    function createNewItemBarbers(barbers = []) {
        var item = '';
        barbers.forEach(barber => {

            item +=
                `<div class="item">
                    <div class="right floated content">
                        <button class="ui primary button inverted" onclick="changePhoto('${barber.dsImagePath}', '${barber.idBarber}');" style="min-width: 150px;">
                            <img class="ui avatar image" src="${barber.dsImagePath}" >
                            <span style="color: black;">${barber.nmBarber}</span>
                        </button>
                    </div>                           
                </div>`

        });

        listItemBarbers.innerHTML = item;

    }

    function advanceToAttendance() {

        $('#modalBarbers').transition('fade right')
        $('#modalAttendance').transition('fade left')
    }
</script>