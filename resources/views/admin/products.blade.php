@extends('layout.app')

@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticIns">
        New
    </button>

    <select id="selNum" class="form-select" aria-label="Select number of record per page">
        <option value="0" selected>Select</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>

    <table class="table table-responsive">
        <thead class="text-center">
            <tr>
                <th scope="col" width="5.11%">#</th>
                <th scope="col" width="12.11%">Img</th>
                <th scope="col" width="14.11%">Title</th>
                <th scope="col" width="14.11%">Description</th>
                <th scope="col" width="11.11%">Category</th>
                <th scope="col" width="11.11%">Subcategory</th>
                <th scope="col" width="10.11%">Price</th>
                <th scope="col" width="10.11%">Stock</th>
                <th scope="col" width="11.11%">Action</th>
            </tr>
        </thead>
        <tbody id="dataTbl" class="text-center"></tbody>
    </table>

    <div id="ppCon"></div>

  <!-- Modal -->
  <div class="modal fade" id="staticIns" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Insert product" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="insBody">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="addProd">
                @csrf
                <input type="hidden" name="usr" id="usr" value="{{ Auth::user()->id }}">
                <div class="mb-3" id="imgForm">
                    <label for="images" class="form-label">Upload photos:</label>
                    <input  class="form-control form-control-sm" id="images" name="images[]" type="file" accept="image/png, image/jpg, image/jpeg" multiple>
                </div>
                <div id="previewImg" class="d-flex justify-content-center flex-row flex-wrap align-items-center border"></div>
                  <div class="mb-3">
                    <label for="name" class="form-label">Name: </label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div>
                  <div class="mb-3">
                      <label for="description" class="form-label">Description:</label>
                      <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                </div>
                <div class="d-flex flex-column flex-sm-row mb-3">
                    <div class="me-auto">
                        <select class="form-select" id="catg" aria-label="Select categories">
                            <option selected>Category</option>
                            <option value="AP">Apparel</option>
                            <option value="BK">Book</option>
                            <option value="GT">Gourmet</option>
                            <option value="MD">Media</option>
                            <option value="PC">Personal Care</option>
                          </select>
                    </div>
                    <div>
                        <select class="form-select" id="subcatg" aria-label="Select subcategories">
                            <option selected>Subcategory</option>
                        </select>
                    </div>
                </div>
                    <div class="mb-3">
                      <label for="price" class="form-label">Price:</label>
                      <input type="number" class="form-control" min="1" max="50000" step=".01" id="price" name="price">
                    </div>
                    <div class="mb-3">
                      <label for="stock" class="form-label">Stock:</label>
                      <input type="number" class="form-control" min="1" max="1000000000" id="stock" name="stock">
                    </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="staticUpd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Edit product details" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Product Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="updBody">
            <form action="{{ route('products.update') }}" method="POST" enctype="multipart/form-data" id="updProd">
                @csrf
                <input type="hidden" name="updUsr" id="updUsr" value="{{ Auth::user()->id }}">
                <input type="hidden" name="updRef" id="updRef">
                <div class="mb-3" id="updImgForm">
                    <label for="updImages" class="form-label">Upload photos:</label>
                    <input  class="form-control form-control-sm" id="updImages" name="updImages[]" type="file" accept="image/png, image/jpg, image/jpeg" multiple>
                </div>
                <div id="updPreviewImg" class="d-flex justify-content-center flex-row flex-wrap align-items-center border"></div>
                  <div class="mb-3">
                    <label for="updName" class="form-label">Name: </label>
                    <input type="text" class="form-control" id="updName" name="updName">
                  </div>
                  <div class="mb-3">
                      <label for="updDescription" class="form-label">Description:</label>
                      <textarea class="form-control" id="updDescription" name="updDescription" rows="4"></textarea>
                </div>
                <div class="d-flex flex-column flex-sm-row mb-3">
                    <div class="me-auto">
                        <select class="form-select" id="updCatg" aria-label="Select categories">
                            <option selected>Category</option>
                            <option value="AP">Apparel</option>
                            <option value="BK">Book</option>
                            <option value="GT">Gourmet</option>
                            <option value="MD">Media</option>
                            <option value="PC">Personal Care</option>
                          </select>
                    </div>
                    <div>
                        <select class="form-select" id="updSubcatg" aria-label="Select subcategories">
                            <option selected>Subcategory</option>
                        </select>
                    </div>
                </div>
                    <div class="mb-3">
                      <label for="updPrice" class="form-label">Price:</label>
                      <input type="number" class="form-control" min="1" max="50000" step=".01" id="updPrice" name="updPrice">
                    </div>
                    <div class="mb-3">
                      <label for="updStock" class="form-label">Stock:</label>
                      <input type="number" class="form-control" min="1" max="1000000000" id="updStock" name="updStock">
                    </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="staticDel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Delete product" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Delete Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="desBody">
            <div id="desWarn"></div>
            <form action="{{ route('products.destroy') }}" method="POST" id="desProd">
                @csrf
                <input type="hidden" name="desUsr" id="desUsr" value="{{ Auth::user()->id }}">
                <input type="hidden" name="desRef" id="desRef">
                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>
    window.addEventListener('load', newProduct);

    function newProduct()
    {
        const addProd = document.getElementById('addProd');
        const img = document.getElementById('images');
        const updImg = document.getElementById('updImages');
        const catg = document.getElementById('catg');
        const updCatg = document.getElementById('updCatg');
        const selNum = document.getElementById('selNum');

        if (addProd) {
            addProd.addEventListener('submit', storeProd);
        }

        if (img) {
            img.addEventListener('change', fileUpl);
        }

        if (updImg) {
            updImg.addEventListener('change', fileUpl);
        }

        if (catg) {
            catg.addEventListener('change', updSelect);
        }

        if (updCatg) {
            updCatg.addEventListener('change', updSelect);
        }

        if (selNum) {
            selNum.addEventListener('change', changeRec);
        }

        getProd(1, 5);
    }

    function getProd(minRec, maxRec)
    {
        axios.get('/admin/products/all')

        .then (response => {
            const prodGet = response.data;

            console.log('prod: ', prodGet.prod);

            genBtn(prodGet, minRec, maxRec);
            chunkRec(prodGet, minRec, maxRec);
        })

        .catch (error => {
            console.log('err: ', error);
        });
    }

    function genBtn(list, startIdx, len)
    {
        let ppNum = 1;
        const ppCon = document.getElementById('ppCon');
        ppCon.innerHTML = '';

        const pNumCon = document.createElement('div');
        pNumCon.classList.add('btn-group');
        pNumCon.setAttribute('role', 'group');
        pNumCon.setAttribute('aria-label', 'List of page buttons');

        if (list.prod.length > 1) {
            ppNum = Math.ceil(list.prod.length / len);

            // if (ppNum < 6) {
                for (let i = 1; i <= ppNum; i++) {
                    const pNumBtn = document.createElement('button');
                    pNumBtn.type = 'button';
                    pNumBtn.dataset.page = i;
                    pNumBtn.classList.add('btn', 'btn-primary');
                    pNumBtn.innerHTML = i;

                    pNumBtn.addEventListener('click', func => {
                        chunkRec(list, parseInt(func.target.dataset.page), len);
                    });

                    pNumCon.appendChild(pNumBtn);
                }

                ppCon.appendChild(pNumCon);
            // }
        }
    }

    function chunkRec(list, currPage, chunkLen)
    {
        let chunkGet = null;
        const dataTbl = document.getElementById('dataTbl');
        dataTbl.innerHTML = '';
        let ctr = ((chunkLen * currPage) - chunkLen) + 1;
        let imgCtr = 1;

        if (list.prod.length > chunkLen || list.prod.length < chunkLen) {
            chunkGet = list.prod.slice((chunkLen * currPage) - chunkLen, (chunkLen * currPage));
        } else if (list.prod.length == chunkLen) {
            chunkGet = list.prod.slice((chunkLen * currPage) - chunkLen);
        }

        for (let i = 0; i < chunkGet.length; i++) {
            console.log('ref: ', chunkGet[i].reference);
            const tblRow = document.createElement('tr');
            tblRow.id = 'tblRow' + (i + 1);
            const tblHdr = document.createElement('th');
            tblHdr.scope = 'row';
            const tblImg = document.createElement('td');
            const tblThumbImg = document.createElement('img');
            const tblTitle = document.createElement('td');
            const tblDesc = document.createElement('td');
            const tblCatg = document.createElement('td');
            const tblSubcatg = document.createElement('td');
            const tblPr = document.createElement('td');
            const tblStk = document.createElement('td');
            const tblAct = document.createElement('td');
            const tblActUpd = document.createElement('button');
            const tblActDel = document.createElement('button');

            tblHdr.innerHTML = ctr++;

            for (let listIdx = 0; listIdx < chunkGet[i].images.length; listIdx++) {
                if (chunkGet[i].images[listIdx].prod_img.image_id == 1) {
                    // console.log('HELUU');
                    tblThumbImg.style.objectFit = 'cover';
                    tblThumbImg.style.width = '100px';
                    tblThumbImg.style.height = '100px';
                    tblThumbImg.src = '/' + chunkGet[i].images[listIdx].prod_img.path;
                } else if (chunkGet[i].images[listIdx].prod_img.image_id == 2) {
                    const auxSrc = 'auxSrc' + imgCtr++;
                    tblActUpd.dataset[auxSrc] = '/' + chunkGet[i].images[listIdx].prod_img.path
                }
            }

            tblTitle.innerHTML = chunkGet[i].name;
            tblDesc.innerHTML = chunkGet[i].description;

            for (let listIdx = 0; listIdx < list.catg.length; listIdx++) {
                if (list.catg[listIdx].id == chunkGet[i].category_id) {
                    tblCatg.innerHTML = list.catg[listIdx].name;
                    tblActUpd.dataset.category_id = list.catg[listIdx].reference;
                    break;
                }
            }

            for (let listIdx = 0; listIdx < list.subcatg.length; listIdx++) {
                if (list.subcatg[listIdx].id == chunkGet[i].subcategory_id) {
                    tblSubcatg.innerHTML = list.subcatg[listIdx].name;
                    tblActUpd.dataset.subcategory_id = list.subcatg[listIdx].reference;
                    break;
                }
            }

            tblPr.innerHTML = chunkGet[i].price;
            tblStk.innerHTML = chunkGet[i].stock;

            tblActUpd.classList.add('btn');
            tblActUpd.dataset.bsToggle = 'modal';
            tblActUpd.dataset.bsTarget = '#staticUpd';
            tblActUpd.innerHTML = 'Update';
            tblActUpd.dataset.row = tblRow.id;
            tblActUpd.dataset.thumbSrc = tblThumbImg.src;
            tblActUpd.dataset.name = chunkGet[i].name;
            tblActUpd.dataset.description = chunkGet[i].description;
            tblActUpd.dataset.price = chunkGet[i].price;
            tblActUpd.dataset.stock = chunkGet[i].stock;
            tblActUpd.dataset.ref = chunkGet[i].reference;
            tblActDel.classList.add('btn');
            tblActDel.dataset.bsToggle = 'modal';
            tblActDel.dataset.bsTarget = '#staticDel';
            tblActDel.innerHTML = 'Delete';
            tblActDel.dataset.row = tblRow.id;
            // tblActDel.dataset.thumbSrc = tblThumbImg.src;
            tblActDel.dataset.name = chunkGet[i].name;
            // tblActDel.dataset.description = chunkGet[i].description;
            // tblActDel.dataset.price = chunkGet[i].price;
            // tblActDel.dataset.stock = chunkGet[i].stock;
            tblActDel.dataset.ref = chunkGet[i].reference;

            tblActUpd.addEventListener('click', populateEl);
            tblActDel.addEventListener('click', populateEl)

            tblRow.appendChild(tblHdr);
            tblImg.appendChild(tblThumbImg);
            tblRow.appendChild(tblImg);
            tblRow.appendChild(tblTitle);
            tblRow.appendChild(tblDesc);
            tblRow.appendChild(tblCatg);
            tblRow.appendChild(tblSubcatg);
            tblRow.appendChild(tblPr);
            tblRow.appendChild(tblStk);
            tblAct.appendChild(tblActUpd);
            tblAct.appendChild(tblActDel);
            tblRow.appendChild(tblAct);

            dataTbl.appendChild(tblRow);
        }
    }

    function changeRec(chg)
    {
        const selNumCon = document.getElementById(chg.target.id).children;

        for (let i of selNumCon) {
            if (i.value != 0 && i.selected) {
                getProd(1, i.value);
            }
        }
    }

    function fileUpl()
    {

        console.log('this file: ', this);
        let previewImg = null;

        if (this.id.includes('upd')) {
            console.log('updddd');
            previewImg = document.getElementById('updPreviewImg');

        } else {
            console.log('NOT updddd');
            previewImg = document.getElementById('previewImg');
        }

        previewImg.innerHTML = '';

        if (this.files) {
            for (const x of this.files) {
                let fileReader = new FileReader();

                fileReader.addEventListener('load', e => {

                    if (previewImg) {
                        const divTmp = document.createElement('div');
                        divTmp.className = 'd-flex bg-secondary bg-opacity-25 m-2';
                        divTmp.id = 'img' + x.name;
                        const imageTmp = document.createElement('img');
                        imageTmp.className = 'mx-auto d-block flex-shrink-0 p-2';
                        imageTmp.src = e.target.result;
                        imageTmp.style.objectFit = 'cover';
                        imageTmp.style.width = '200px';
                        imageTmp.style.height = '200px';

                        divTmp.addEventListener('click', photoSelect);

                        divTmp.appendChild(imageTmp);
                        previewImg.appendChild(divTmp);
                    }
                })

                fileReader.readAsDataURL(x);
            }
        }
    }

    function photoSelect(img) {
        console.log('img: ', img);
        const prevwID = document.getElementById(this.id);
        const prevwCont = prevwID.parentNode.children;

        for (let i = 0; i < prevwCont.length; i++) {
            prevwCont[i].classList.replace('bg-primary', 'bg-secondary');
        }

        if (prevwID.contains(img.target)) {
            prevwID.classList.replace('bg-secondary', 'bg-primary');
            prevwID.dataset.state = 'img-selected';
        }
    }

    function updSelect()
    {
        const catgRef = this.children; // this.children
        let catgRefVal = null; // catg val

        console.log('this: ', this);

        for (let i = 1; i < catgRef.length; i++) {
            if (catgRef[i].selected == true) {
                catgRefVal = catgRef[i].value;
                this.id.includes('upd') ? updSelectSub(catgRefVal, 'upd', true) : updSelectSub(catgRefVal, 'ins');
                break;
            }
        }
    }

    function updSelectSub(catgRefVal, type, init, subcatVal)
    {
        // console.log('val: ', catgRefVal);
        // console.log('type: ', type);
        // console.log('init: ', init);
        // console.log('subcatVal: ', subcatVal);

        let subcatg = null;
        const subcatgHeader = document.createElement('option');

        if (type == 'ins') {
            subcatg = document.getElementById('subcatg');
            subcatgHeader.selected = true;
        } else if (type == 'upd') {
            subcatg = document.getElementById('updSubcatg');

            if (init) {
                subcatgHeader.selected = true;
            }
        }

        subcatg.innerHTML = '';

        const subcatgFHR = document.createElement('option');
        subcatgFHR.value = 'FHR';
        subcatgFHR.innerHTML = 'For Her';
        const subcatgFHM = document.createElement('option');
        subcatgFHM.value = 'FHM';
        subcatgFHM.innerHTML = 'For Him';

        subcatgHeader.innerHTML = tempLit`${catgRefVal}`;

        if (catgRefVal === 'AP') {
            if (!init) {
                (subcatVal == 'FHR') ? subcatgFHR.selected = true :
                (subcatVal == 'FHM') ? subcatgFHM.selected = true : null;
            }

            subcatg.appendChild(subcatgFHR);
            subcatg.appendChild(subcatgFHM);
        } else if (catgRefVal === 'BK') {
            const subcatgAAC = document.createElement('option');
            subcatgAAC.value = 'AAC';
            subcatgAAC.innerHTML = 'Art';
            const subcatgFTN = document.createElement('option');
            subcatgFTN.value = 'FTN';
            subcatgFTN.innerHTML = 'Fiction';
            const subcatgPHL = document.createElement('option');
            subcatgPHL.value = 'PHL';
            subcatgPHL.innerHTML = 'Philosophy';
            const subcatgPSY = document.createElement('option');
            subcatgPSY.value = 'PSY';
            subcatgPSY.innerHTML = 'Psychology';
            const subcatgSFH = document.createElement('option');
            subcatgSFH.value = 'SFH';
            subcatgSFH.innerHTML = 'Self-Help';

            if (!init) {
                (subcatVal == 'AAC') ? subcatgAAC.selected = true :
                (subcatVal == 'FTN') ? subcatgFTN.selected = true :
                (subcatVal == 'PHL') ? subcatgPHL.selected = true :
                (subcatVal == 'PSY') ? subcatgPSY.selected = true :
                (subcatVal == 'SFH') ? subcatgSFH.selected = true : null;
            }

            subcatg.appendChild(subcatgAAC);
            subcatg.appendChild(subcatgFTN);
            subcatg.appendChild(subcatgPHL);
            subcatg.appendChild(subcatgPSY);
            subcatg.appendChild(subcatgSFH);
        } else if (catgRefVal === 'GT') {
            const subcatgCAT = document.createElement('option');
            subcatgCAT.value = 'CAT';
            subcatgCAT.innerHTML = 'Coffee &#x26; Tea';
            const subcatgSNK = document.createElement('option');
            subcatgSNK.value = 'SNK';
            subcatgSNK.innerHTML = 'Snacks';

            if (!init) {
                (subcatVal == 'CAT') ? subcatgCAT.selected = true :
                (subcatVal == 'SNK') ? subcatgSNK.selected = true : null;
            }

            subcatg.appendChild(subcatgCAT);
            subcatg.appendChild(subcatgSNK);
        } else if (catgRefVal === 'MD') {
            const subcatgAUD = document.createElement('option');
            subcatgAUD.value = 'AUD';
            subcatgAUD.innerHTML = 'Audio';
            const subcatgPTG = document.createElement('option');
            subcatgPTG.value = 'PTG';
            subcatgPTG.innerHTML = 'Photography';

            if (!init) {
                (subcatVal == 'AUD') ? subcatgAUD.selected = true :
                (subcatVal == 'PTG') ? subcatgPTG.selected = true : null;
            }

            subcatg.appendChild(subcatgAUD);
            subcatg.appendChild(subcatgPTG);
        } else if (catgRefVal === 'PC') {
            if (!init) {
                (subcatVal == 'FHR') ? subcatgFHR.selected = true :
                (subcatVal == 'FHM') ? subcatgFHM.selected = true : null;
            }

            subcatg.appendChild(subcatgFHR);
            subcatg.appendChild(subcatgFHM);
        }

        subcatg.prepend(subcatgHeader);
    }

    function tempLit(str, val)
    {
        const tempVal = val;
        let tempStr;

        tempStr = tempVal === 'AP' ? 'apparel' :
                  tempVal === 'BK' ? 'book' :
                  tempVal === 'GT' ? 'gourmet' :
                  tempVal === 'MD' ? 'media' :
                  tempVal === 'PC' ? 'personal care' :
                  'undefined';

        return `Select ${tempStr} subcategory`;
    }

    function storeProd(e)
    {
        e.preventDefault();

        const catgCh = this.catg.children;
        const subcatgCh = this.subcatg.children;
        const imgCh = this.images.files;
        const prevwCh = document.getElementById('previewImg').children;
        let catgV;
        let subcatgV;
        let thumbV;

        console.log(prevwCh.length);

        for (let i = 1; i < catgCh.length; i++) {
            catgCh[i].selected == true ? catgV = catgCh[i].value : null;
        }

        for (let i = 1; i < subcatgCh.length; i++) {
            subcatgCh[i].selected == true ? subcatgV = subcatgCh[i].value : null;
        }

        for (let i = 0; i < prevwCh.length; i++) {
            if (prevwCh[i].dataset.state == 'img-selected') {
                thumbV = prevwCh[i];
            }
        }

        if (!thumbV) {
            console.log('error!');

            return false;
        } else {
            console.log(thumbV.id);
        }

        const strParam = new FormData();

        strParam.append('usr', this.usr.value);
        strParam.append('name', this.name.value);
        strParam.append('description', this.description.value);
        strParam.append('catg', catgV);
        strParam.append('subcatg', subcatgV);
        strParam.append('price', this.price.value);
        strParam.append('stock', this.stock.value);

        if (imgCh.length != 0) {
            for (let i = 0; i < imgCh.length; i++) {
                if ('img' + imgCh[i].name == thumbV.id) {
                    strParam.append('thumb_v', imgCh[i]);
                } else {
                    strParam.append('aux[]', imgCh[i]);
                }
            }
        }

        console.log('new th: ', thumbV);

        axios.post(this.action, strParam)

        .then (success => {
            console.log('success: ', success);
        })

        .catch (error => {
            console.log(error);
            console.log(error.response.data.errors);
        })
    }

    function populateEl(el)
    {
        console.log('el: ', el.target);

        if (el.target.dataset.bsTarget.includes('Upd')) {
            const updProd = document.getElementById('updProd');
            updProd.addEventListener('submit', editProd);
            const updPreviewImg = document.getElementById('updPreviewImg');
            updPreviewImg.innerHTML = '';
            const updSelCatg = document.getElementById('updCatg').children;
            const updSelSubcatg = document.getElementById('updSubcatg');

            const updRow = el.target.dataset.row;
            const updRef = el.target.dataset.ref;
            const updName = el.target.dataset.name;
            const updDesc = el.target.dataset.description;
            const updCatgRef = el.target.dataset.category_id;
            const updSubcatgRef = el.target.dataset.subcategory_id;
            const updPr = el.target.dataset.price;
            const updStk = el.target.dataset.stock;
            let updThumbSrc = null;
            let updAux = null;

            const all = el.target.dataset;

            for (let i in all) {
                if (i.startsWith('thumb')) {
                    const thumbDiv = document.createElement('div');
                    thumbDiv.className = 'd-flex bg-primary bg-opacity-25 m-2';
                    const thumbImg = document.createElement('img');
                    thumbImg.className = 'mx-auto d-block flex-shrink-0 p-2';
                    thumbImg.src = all[i];
                    thumbImg.style.objectFit = 'cover';
                    thumbImg.style.width = '200px';
                    thumbImg.style.height = '200px';
                    updThumbSrc = all[i];

                    thumbDiv.appendChild(thumbImg);
                    updPreviewImg.prepend(thumbDiv);
                } else if (i.startsWith('aux')) {
                    const auxDiv = document.createElement('div');
                    auxDiv.className = 'd-flex bg-secondary bg-opacity-25 m-2';
                    const auxImg = document.createElement('img');
                    auxImg.className = 'mx-auto d-block flex-shrink-0 p-2';
                    auxImg.src = all[i];
                    auxImg.style.objectFit = 'cover';
                    auxImg.style.width = '200px';
                    auxImg.style.height = '200px';

                    auxDiv.appendChild(auxImg);
                    updPreviewImg.appendChild(auxDiv);
                }
            }

            for (let i = 0; i < updSelCatg.length; i++) {
                if (updSelCatg[i].value == updCatgRef) {
                    updSelCatg[i].selected = true;
                    updSelectSub(updSelCatg[i].value, 'upd', false, updSubcatgRef);
                    break;
                }
            }

            updProd.updRef.value = updRef;
            updProd.updName.value = updName;
            updProd.updDescription.value = updDesc;
            updProd.updPrice.value = updPr;
            updProd.updStock.value = updStk;
        } else if (el.target.dataset.bsTarget.includes('Del')) {
            const desProd = document.getElementById('desProd');
            const desWarn = document.getElementById('desWarn');
            desWarn.innerHTML = '';
            const desName = el.target.dataset.name;
            const desHdr = document.createElement('div');
            const desRow = el.target.dataset.row;
            const desRef = el.target.dataset.ref;

            desProd.desRef.value = desRef;
            desProd.dataset.row = desRow;

            desWarn.classList.add('alert', 'alert-warning');

            desHdr.innerHTML = 'Are you sure you want to delete ' + desName + '&#x3f; This action is irreversible.';

            desWarn.prepend(desHdr);
            desProd.addEventListener('submit', dstrProd);
        }
    }

    function editProd(ed)
    {
        ed.preventDefault();

        console.log('HI! ', ed.target);

        const edCatg = this.updCatg.children;
        const edSubcatg = this.updSubcatg.children;
        const edImgs = this.updImages.files;
        const edImgCon = document.getElementById('updPreviewImg').children;
        let edCatgV = null;
        let edSubcatgV = null;
        let edThumbV = null;

        for (let i = 1; i < edCatg.length; i++) {
            edCatg[i].selected == true ? edCatgV = edCatg[i].value : null;
        }

        for (let i = 1; i < edSubcatg.length; i++) {
            edSubcatg[i].selected == true ? edSubcatgV = edSubcatg[i].value : null;
        }

        const updParam = new FormData();

        updParam.append('usr', this.updUsr.value);
        updParam.append('name', this.updName.value);
        updParam.append('description', this.updDescription.value);
        updParam.append('catg', edCatgV);
        updParam.append('subcatg', edSubcatgV);
        updParam.append('price', this.updPrice.value);
        updParam.append('stock', this.updStock.value);
        updParam.append('ref', this.updRef.value);

        console.log('sub: ', edSubcatgV);
        console.log('catg: ', edCatgV);

        if (edImgs.length != 0) {
            console.log('with files');
            for (let i = 0; i < edImgCon.length; i++) {
                if (edImgCon[i].dataset.state == 'img-selected') {
                    edThumbV = edImgCon[i];
                    break;
                }
            }

            if (!edThumbV) {
                console.log('ERROR! NO THUMBNAIL SELECTED');
            } else {
                for (let i = 0; i < edImgs.length; i++) {
                    console.log('i: ', edImgs[i]);
                    if ('img' + edImgs[i].name == edThumbV.id) {
                        console.log('thumbnail: ', edThumbV.id);
                        updParam.append('thumb_v', edImgs[i]);
                    } else {
                        console.log('aux: ', edImgs[i].name);
                        updParam.append('aux[]', edImgs[i]);
                    }
                }
            }
        } else {
            console.log('no file');
        }

        axios.post(this.action, updParam)

        .then (response => {
            console.log('response: ', response)
        })

        .catch (error => {
            console.log('erro: ', error);
        })
    }

    function dstrProd(dstr)
    {
        dstr.preventDefault();

        console.log('destr', this);

        const dstrParam = new FormData();

        dstrParam.append('usr', this.desUsr.value);
        dstrParam.append('ref', this.desRef.value);

        axios.post(this.action, dstrParam)

        .then (response => {
            console.log('response: ', response);
        })

        .catch (error => {
            console.log('error: ', error);
        })

    }
</script>
@endsection
