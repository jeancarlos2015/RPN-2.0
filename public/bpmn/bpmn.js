var diagramUrl = 'http://projeto.test/novo_bpmn/novo.bpmn';

// modeler instance
var bpmnModeler = new BpmnJS({
    container: '#canvas',
    keyboard: {
        bindTo: window
    }
});

/**
 * Save diagram contents and print them to the console.
 */

function exportDiagram(codmodelo) {

    bpmnModeler.saveXML({ format: true }, function(err, xml) {
        $.ajax({

            url: 'gravar',
            type: "POST",
            cache: false,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') ,
                strXml: xml,
                codmodelo: codmodelo
            },
            
            success: function () {
                alert('Modelo Salvo Com suceso!!');
            },
            error: function () {
                alert('Erro ao salvar modelo');
            }
            
        });

    });
}

/**
 * Open diagram in our modeler instance.
 *
 * @param {String} bpmnXML diagram to display
 */
function openDiagram(bpmnXML) {

    // import diagram
    bpmnModeler.importXML(bpmnXML, function (err) {

        if (err) {
            return console.error('could not import BPMN 2.0 diagram', err);
        }

        // access modeler components
        var canvas = bpmnModeler.get('canvas');
        var overlays = bpmnModeler.get('overlays');


        // zoom to fit full viewport
        canvas.zoom('fit-viewport');

        // attach an overlay to a node
        overlays.add('SCAN_OK', 'note', {
            position: {
                bottom: 0,
                right: 0
            },
            html: '<div class="diagram-note">Mixed up the labels?</div>'
        });

        // add marker
        canvas.addMarker('SCAN_OK', 'needs-discussion');
        bpmnModeler.attachTo('#canvas');
        bpmnModeler.detach();
    });
}


// load external diagram file via AJAX and open it
$.get(diagramUrl, openDiagram, 'text');

// // wire save button
// $('#save-button').click(exportDiagram);
// $('#save-button2').click(exportDiagram);
// $('#save-button3').click(exportDiagram);
//


