import $ from 'jquery';
import Mustache from 'mustache/mustache.mjs';
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.min';

const templateRow = $('#template-table-municipality').html();
const templateError = $('#template-table-municipality-empty').html();

const modalDeleteElement = document.getElementById('deleteMunicipalityModal');
let modalDelete = new bootstrap.Modal(modalDeleteElement, {});
let currentDeleteMunicipalityId = null;

const toast = document.getElementById('js-ajax-message');

modalDeleteElement.addEventListener('hidden.bs.modal', function (event) {
    currentDeleteMunicipalityId = null;
});

function showToastMessage(message) {
    $('#js-ajax-message-content', toast).html(message);
    bootstrap.Toast.getOrCreateInstance(toast).show();
}

function drawRows(rows) {
    let renderHtmlRows = Mustache.render(templateRow, {'rows': rows});
    $('#js-table-municipality-body').html(renderHtmlRows);
    showToastMessage('Municipio borrado correctamente');
}

function drawError() {
    $('#js-table-municipality-body').html(templateError);
}

function loadMunicipalities() {
    $.ajax({
        url: '/api/municipalities',
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (result) {
            if (result.success === true) {
                drawRows(result.data)
                addClickEventToMunicipalityDeleteButton();
            } else {
                drawError();
            }
        }
    });
}

function confirmMunicipalityDeletion() {
    if (null !== currentDeleteMunicipalityId) {
        $.ajax({
            url: `/api/municipality/${currentDeleteMunicipalityId}`,
            type: 'DELETE',
            cache: false,
            dataType: 'json',
            success: function (result) {
                if (result.success === true) {
                    $(`#js-table-municipality-row-${currentDeleteMunicipalityId}`).remove();
                    currentDeleteMunicipalityId = null;
                    modalDelete.hide();
                    showToastMessage('Municipio borrado correctamente');
                }
            }
        });
    }
}

function deleteMunicipality(event) {
    const municipalityId = $(event.currentTarget).attr('data-municipality-id');
    const municipalityName = $(event.currentTarget).attr('data-municipality-name');

    $('#delete-municipality-modal-name').text(municipalityName);
    currentDeleteMunicipalityId = municipalityId;

    modalDelete.show();
}

function addClickEventToMunicipalityDeleteButton() {
    $('.js-trigger-delete-municipality').on('click', function (e) {
        deleteMunicipality(e);
    });
}

function addClickEventToConfirmMunicipalityDeletion() {
    $('#js-municipality-deleter').on('click', confirmMunicipalityDeletion);
}

function enableAlertSystem() {
    $('.alert').each(function (alert) {
        new bootstrap.Alert(alert)
    });
}

export default function() {
    loadMunicipalities();
    addClickEventToMunicipalityDeleteButton();
    addClickEventToConfirmMunicipalityDeletion();
    enableAlertSystem();
};