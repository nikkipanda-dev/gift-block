@extends('layout.app')

@section('content')
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    New
  </button>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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

<script>
    window.addEventListener('load', newProduct);

    function newProduct()
    {
        const addProd = document.getElementById('addProd');
        const img = document.getElementById('images');
        const catg = document.getElementById('catg');

        if (addProd) {
            addProd.addEventListener('submit', storeProd);
        }

        if (img) {
            img.addEventListener('change', fileUpl);
        }

        if (catg) {
            catg.addEventListener('change', updSelect);
        }
    }

    function fileUpl()
    {
        if (this.files) {
            console.log('len: ', this.files.length);
            for (const x of this.files) {
                let fileReader = new FileReader();

                fileReader.addEventListener('load', e => {
                    const previewImg = document.getElementById('previewImg');

                    if (previewImg) {
                        const divTmp = document.createElement('div');
                        divTmp.className = 'd-flex border bg-primary bg-opacity-25 m-2';
                        const imageTmp = document.createElement('img');
                        imageTmp.className = 'img-thumbnail mx-auto d-block flex-shrink-0';
                        imageTmp.src = e.target.result;
                        imageTmp.style.objectFit = 'cover';
                        imageTmp.style.width = '200px';
                        imageTmp.style.height = '200px';

                        divTmp.appendChild(imageTmp);
                        previewImg.appendChild(divTmp);
                    }
                })

                fileReader.readAsDataURL(x);
            }
        }
    }

    function storeProd(e)
    {
        e.preventDefault();

        const catgCh = this.catg.children;
        const subcatgCh = this.subcatg.children;
        let catgV;
        let subcatgV;

        for (let i = 1; i < catgCh.length; i++) {
            catgCh[i].selected == true ? catgV = catgCh[i].value : null;
        }

        for (let i = 1; i < subcatgCh.length; i++) {
            subcatgCh[i].selected == true ? subcatgV = subcatgCh[i].value : null;
        }

        const strParam = new FormData();

        strParam.append('usr', this.usr.value);
        strParam.append('name', this.name.value);
        strParam.append('description', this.description.value);
        strParam.append('catg', catgV);
        strParam.append('subcatg', subcatgV);
        strParam.append('price', this.price.value);
        strParam.append('stock', this.stock.value);

        if (this.images.files) {
            strParam.append('images', this.images.files);
        }

        axios.post(this.action, strParam)

        .then (success => {
            console.log('success: ', success);
        })

        .catch (error => {
            console.log(error);
            console.log(error.response.data.errors);
        })
    }

    function updSelect()
    {
        const subcatg = document.getElementById('subcatg');
        const catgRef = this.children;
        const subcatgHeader = document.createElement('option');
        subcatgHeader.selected = true;
        const subcatgFHR = document.createElement('option');
        subcatgFHR.value = 'FHR';
        subcatgFHR.innerHTML = 'For Her';
        const subcatgFHM = document.createElement('option');
        subcatgFHM.value = 'FHM';
        subcatgFHM.innerHTML = 'For Him';
        let catgRefVal;

        subcatg.innerHTML = '';

        for (let i = 1; i < catgRef.length; i++) {
            if (catgRef[i].selected == true) {
                catgRefVal = catgRef[i].value;
                subcatgHeader.innerHTML = tempLit`${catgRefVal}`;
                if (catgRefVal === 'AP') {
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

                    subcatg.appendChild(subcatgCAT);
                    subcatg.appendChild(subcatgSNK);
                } else if (catgRefVal === 'MD') {
                    const subcatgAUD = document.createElement('option');
                    subcatgAUD.value = 'AUD';
                    subcatgAUD.innerHTML = 'Audio';
                    const subcatgPTG = document.createElement('option');
                    subcatgPTG.value = 'PTG';
                    subcatgPTG.innerHTML = 'Photography';

                    subcatg.appendChild(subcatgAUD);
                    subcatg.appendChild(subcatgPTG);
                } else if (catgRefVal === 'PC') {
                    subcatg.appendChild(subcatgFHR);
                    subcatg.appendChild(subcatgFHM);
                }

                subcatg.prepend(subcatgHeader);
                break;
            }
        }
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
</script>
@endsection
