/**
 * Seta o tamanho da imagem no image path para mostrar em diferentes tamanhos
 * @param {string} imgPath caminho do arquivo
 * @param {*} sizename tamanho da imagem
 * @returns caminho do arquivo com o tamanho correto
 */
function replaceSizeImage(imgPath = '', sizename = 'small') {
    if (imgPath == '') {
        return '';
    }
    return imgPath.replace('SIZEIMG', sizename);
}
