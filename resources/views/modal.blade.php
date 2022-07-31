{{-- Modal que buscará o arquivo XML --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Importar NF-e</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="file" name="nfe" id="nfe">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark" onclick="EnviarDados()">Salvar NF-e</button>
            </div>
        </div>
    </div>
</div>

{{-- Referenciando arquivo JS responsável pelas requisições --}}
<script src="/js/requisicoes.js"></script>