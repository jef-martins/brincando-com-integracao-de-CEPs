<h3>Digite o CEP para buscar</h3>
<form id="clientForm">
    <div class="form-group">
        <label for="nome">CEP:</label>
        <input type="text" class="form-control" id="txtCep" name="txtCep" required>
    </div>
    <div class="form-group">
        <label for="apis">Escolha uma api para buscar:</label>
        <select id="apis" name="apis" class="form-select" aria-label="Default select example">
            <option value="viaCep" selected>viaCEP</option>
            <option value="brasilApi">Brasil API</option>
            <option value="CepAberto">CEP Aberto</option>
        </select>
    </div>
    <br>
    <button type="submit" class="btn btn-primary" name="btnSalvarCep">Buscar</button>
</form>

<script type="module">
    import { fetchData } from '../request.js';

    function createTable(data) {
        const tableContainer = document.getElementById('table-container');

        while (tableContainer.firstChild) {
            tableContainer.removeChild(tableContainer.firstChild);
        }

        const table = document.createElement('table');
        const thead = document.createElement('thead');
        const tbody = document.createElement('tbody');

        const headerRow = document.createElement('tr');
        const headerKey = document.createElement('th');
        const headerValue = document.createElement('th');
        
        headerKey.textContent = 'Campo';
        headerValue.textContent = 'Informação';

        headerRow.appendChild(headerKey);
        headerRow.appendChild(headerValue);
        thead.appendChild(headerRow);

        for (let key in data) {
            const row = document.createElement('tr');

            const cellKey = document.createElement('td');
            cellKey.textContent = key;

            const cellValue = document.createElement('td');
            cellValue.textContent = typeof data[key] === 'object' ? JSON.stringify(data[key], null, 2) :( data[key] || " - ") ; 

            row.appendChild(cellKey);
            row.appendChild(cellValue);
            tbody.appendChild(row);
        }

        table.appendChild(thead);
        table.appendChild(tbody);

        document.getElementById('table-container').appendChild(table);
    }
            
    document.getElementById('clientForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        const cep = document.getElementById('txtCep').value;
        const api = document.getElementById('apis').value;
        
        const dados = {
            txtCep: cep,
            txtApi: api
        };

        fetchData('../../api/client/integracao.php', 'POST', dados)
        .then(res => {
            console.log(res);
            createTable(res.data);
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    });
</script>