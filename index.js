const tbody = document.querySelector('tbody');
let Gorder = 'name';
let Gdir = 'asc';
const fields = ["id", "name", "openingHours", "telephone", "country", "locality", "region", "code", "streetAddress"]

const addRow = (val) => {
  console.log(val);
  tbody.innerHTML += `
  <tr>
  <td class="action"><span class="delete">&#128465;</span><span class="edit">&#128427;</span></td>
  <td class="input" role="textbox" name="id" />${val['id']}</td>
  <td class="input" role="textbox" name="name" contenteditable>${val['name']}         </td>
  <td class="input" role="textbox" name="openingHours" contenteditable>${val['openingHours']} </td>
  <td class="input" role="textbox" name="telephone" contenteditable>${val['telephone']}    </td>
  <td class="input" role="textbox" name="country" contenteditable>${val['country']}      </td>
  <td class="input" role="textbox" name="locality" contenteditable>${val['locality']}     </td>
  <td class="input" role="textbox" name="region" contenteditable>${val['region']}       </td>
  <td class="input" role="textbox" name="code" contenteditable>${val['code']}         </td>
  <td class="input" role="textbox" name="streetAddress" contenteditable>${val['streetAddress']}</td>
</tr>`;
}

const header = (method, body2b) => {
  return { method, headers: { 'Content-Type': 'application/json', }, body: JSON.stringify(body2b), }
}
const prepFetch = async (method, book) => {
  return await fetch('index.php', header(method, book));
}
const fetchAll = async (order, dir, search={}) => {
  query=new URLSearchParams({order, dir, ...search}).toString()
  const response = await fetch('index.php?' + query);
  return response.json();
};
const addBook = async (book) => {
  const response = await prepFetch('POST', book);
  makeTable();
  return response.json();
}
const deleteBook = async (id) => {
  const response = await prepFetch('DELETE', id);
  makeTable();
  return response.json();
}
const editBook = async (book) => {
  const response = await prepFetch('PUT', book);
  makeTable();
}
const makeTable = async (order = Gorder, dir = Gdir) => {
  Gorder = order;
  Gdir = dir;
  const data = await fetchAll(order, dir);
  tbody.innerHTML = '';
  data.forEach(val => addRow(val));

  document.querySelectorAll('.action .edit').forEach(el => { el.addEventListener('click', e => editBook(jsonifyParentRow(e))) });
  document.querySelectorAll('.action .delete').forEach(el => { el.addEventListener('click', e => deleteBook(jsonifyParentRow(e))) });
}
const jsonifyParentRow = (event) => {
  let row = event.target.parentElement.parentElement;
  let inputs = [].slice.call(row.querySelectorAll('.input'));
  let obj = {};
  inputs.map(inp => obj[inp.getAttribute('name')] = inp.innerText.trim());
  return JSON.stringify(obj);
}
// 9660 == "▼".charCodeAt(0)
const sort = (e) => { makeTable(e.target.name, e.target.innerHTML.charCodeAt(0) == 9660 ? 'desc' : 'asc') }
const search = (e) => { fetchAll(Gorder, Gdir, searchBooks(e)) }

const searchBooks = (e) => {
  let ursl = JSON.parse(jsonifyParentRow(e))
  Object.keys(ursl).forEach(key => ursl[key] === "" && delete ursl[key]);
  return ursl
  // return new URLSearchParams(ursl).toString()
};
document.querySelector('.action .add').addEventListener("click", e => addBook(jsonifyParentRow(e)), false);
document.querySelectorAll('thead a').forEach(href => href.addEventListener("click", sort, false));
document.querySelectorAll('.search').forEach(href => href.addEventListener("click", search, false));

makeTable();