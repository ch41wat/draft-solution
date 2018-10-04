function get_layer(id, disabled) {
    var column = '', layer = 1;
    for (var i = 1; i <= 5; i++) {
        column += '<div class="row">';
        for (var j = 1; j <= 12; j++) {
            column += '<div class="col-md-1 col-xs-1" style="min-height: 80px; border: 1px solid #202020;">' +
                '<div class="row">' +
                    '<a href="#" class="btn btn-link ' + disabled + '" id="link-' + id + '-' + layer + '" data-toggle="modal" data-target="#modal-layer" data-image="' + id + '" data-layer="' + layer + '">' + 
                        layer + 
                    '</a>' + 
                    '<input type="hidden" name="layer_' + id + '_' + layer + '" id="layer-' + id + '-' + layer + '">' +
                '</div>' +
            '</div>';
            layer++;
        }
        column += '</div>';                 
    }
    return column;
}