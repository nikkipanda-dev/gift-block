@extends('layout.app')

@section('content')
    cust prod
    <div class="container-xxl border">
        <div class="row justify-content-center">
            <div class="d-none d-md-grid col-2 bg-info bg-opacity-10">
                <div class="nav flex-column nav-pills me-3" id="vPillsTab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link" id="vPillsAddressTab" data-bs-toggle="pill" data-bs-target="#vPillsAddress" type="button" role="tab" aria-selected="true">All</button>
                    <button class="nav-link" id="vPillsOrdersTab" data-bs-toggle="pill" data-bs-target="#vPillsOrders" type="button" role="tab" aria-selected="false">Orders</button>
                </div>
            </div>
            <div class="d-grid d-md-none bg-info">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab-mo" role="tablist" aria-orientation="vertical">
                    hi
                </div>
            </div>
            <div class="tab-content col-12 col-md-10 bg-secondary bg-opacity-10" id="tabContent">
                <div class="tab-pane fade show active" id="vPillsAddress" role="tabpanel">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropAdr">
                        New address
                    </button>

                    <select id="selNum" class="form-select" aria-label="Select number of record per page">
                        <option value="0" selected>Select</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" id="prodList"></div>
                    <div id="ppCon"></div>
                </div>
                <div class="tab-pane fade" id="vPillsOrders" role="tabpanel">
                    orders
                </div>
            </div>
        </div>
    </div>

    <div id="ppCon"></div>

  <!-- Modal -->
  <div class="modal fade" id="staticQikView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticQikView" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticQikView">Product Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row" id="prodDet">
                <div class="col col-md-4">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab maiores quis magnam veniam impedit id quibusdam enim ducimus placeat tempora.
                </div>
                <div class="col col-md-8">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias cum alias totam, vel iste laboriosam velit libero quisquam nisi inventore.
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>
    window.addEventListener('load', custProd);

    function custProd()
    {
        console.log('loaded');

        getProd(1, 5);
    }

    function getProd(minRec, maxRec)
    {
        axios.get('/shop/products/all')

        .then (response => {
            const prodGet = response.data;

            console.log('prod: ', prodGet);

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
        const prodList = document.getElementById('prodList');
        prodList.innerHTML = '';
        let ctr = ((chunkLen * currPage) - chunkLen) + 1;
        let imgCtr = 1;

        if (list.prod.length > chunkLen || list.prod.length < chunkLen) {
            chunkGet = list.prod.slice((chunkLen * currPage) - chunkLen, (chunkLen * currPage));
        } else if (list.prod.length == chunkLen) {
            chunkGet = list.prod.slice((chunkLen * currPage) - chunkLen);
        }

        console.log(chunkGet);

        for (let i = 0; i < chunkGet.length; i++) {
            console.log('ref: ', chunkGet[i]);

            const prodWrapper = document.createElement('div');
            prodWrapper.classList.add('col');
            prodWrapper.id = 'prod' + (i + 1);
            const cardCon = document.createElement('div');
            cardCon.classList.add('card', 'h-100');
            const cardImg = document.createElement('img');
            cardImg.classList.add('card-img-top');
            const cardBody = document.createElement('div');
            cardBody.classList.add('card-body');
            const cardDet = document.createElement('div');
            cardDet.classList.add('row');
            const cardTit = document.createElement('div');
            cardTit.classList.add('col-12', 'col-xl-8', 'card-title', 'fs-5', 'me-auto');
            const cardPr = document.createElement('div');
            cardPr.classList.add('col-12', 'col-xl-4', 'card-title', 'fs-5');
            const cardStk = document.createElement('div');
            cardStk.classList.add('col');
            const cardBtn = document.createElement('button');

            cardTit.innerHTML = chunkGet[i].name;
            cardPr.innerHTML = chunkGet[i].price;
            cardStk.innerHTML = chunkGet[i].stock;

            for (let listIdx = 0; listIdx < chunkGet[i].images.length; listIdx++) {
                if (chunkGet[i].images[listIdx].prod_img.image_id == 1) {
                    console.log('thumbnail');
                    cardImg.style.objectFit = 'cover';
                    cardImg.style.width = '100px';
                    cardImg.style.height = '100px';
                    cardImg.src = '/' + chunkGet[i].images[listIdx].prod_img.path;
                } else if (chunkGet[i].images[listIdx].prod_img.image_id == 2) {
                    const auxSrc = 'auxSrc' + imgCtr++;
                    cardBtn.dataset[auxSrc] = '/' + chunkGet[i].images[listIdx].prod_img.path
                }
            }

            cardBtn.classList.add('btn');
            cardBtn.dataset.bsToggle = 'modal';
            cardBtn.dataset.bsTarget = '#staticQikView';
            cardBtn.innerHTML = 'Quick View';
            cardBtn.dataset.row = prodWrapper.id;
            cardBtn.dataset.thumbSrc = cardImg.src;
            cardBtn.dataset.name = chunkGet[i].name;
            cardBtn.dataset.description = chunkGet[i].description;
            cardBtn.dataset.price = chunkGet[i].price;
            cardBtn.dataset.stock = chunkGet[i].stock;
            cardBtn.dataset.ref = chunkGet[i].reference;

            cardBtn.addEventListener('click', populateEl);

            cardDet.prepend(cardTit);
            cardDet.appendChild(cardPr);
            cardDet.appendChild(cardStk);
            cardBody.append(cardDet);

            cardCon.appendChild(cardImg);
            cardCon.appendChild(cardBody);
            cardCon.appendChild(cardBtn);

            prodWrapper.appendChild(cardCon);
            prodList.appendChild(prodWrapper);
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

    function populateEl()
    {
        console.log('EHEHEH');
    }
</script>
@endsection
