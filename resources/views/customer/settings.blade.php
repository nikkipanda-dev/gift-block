@extends('layout.app')

@section('content')
    <div class="container-md border">
        <div class="row justify-content-center">
            <div class="d-none d-md-grid col-2 bg-info bg-opacity-10">
                <div class="nav flex-column nav-pills me-3" id="vPillsTab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="vPillsProfileTab" data-bs-toggle="pill" data-bs-target="#vPillsProfile" type="button" role="tab" aria-selected="true">Profile</button>
                    <button class="nav-link" id="vPillsAddressTab" data-bs-toggle="pill" data-bs-target="#vPillsAddress" type="button" role="tab" aria-selected="false">Addresses</button>
                    <button class="nav-link" id="vPillsOrdersTab" data-bs-toggle="pill" data-bs-target="#vPillsOrders" type="button" role="tab" aria-selected="false">Orders</button>
                </div>
            </div>
            <div class="d-grid d-md-none bg-info">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab-mo" role="tablist" aria-orientation="vertical">
                    hi
                </div>
            </div>
            <div class="tab-content col-12 col-md-10 bg-secondary bg-opacity-10" id="tabContent">
                <div class="tab-pane fade show active" id="vPillsProfile" role="tabpanel">
                    Profile<br />
                </div>
                <div class="tab-pane fade" id="vPillsAddress" role="tabpanel">
                    My Addresses <br />

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

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col" width="5.11%">#</th>
                                    <th scope="col" width="14.11%">First Name</th>
                                    <th scope="col" width="14.11%">Last Name</th>
                                    <th scope="col" width="14.11%">Mobile &#x23;</th>
                                    <th scope="col" width="21.11%">Address</th>
                                    <th scope="col" width="5.11%">Region</th>
                                    <th scope="col" width="8.11%">City</th>
                                    <th scope="col" width="5.11%">Zip</th>
                                    <th scope="col" width="11.11%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="dataTbl" class="text-center"></tbody>
                        </table>
                    </div>
                    <div id="ppCon"></div>
                </div>
                <div class="tab-pane fade" id="vPillsOrders" role="tabpanel">
                    orders
                </div>
            </div>
        </div>
    </div>

  <!-- New Adr Modal -->
  <div class="modal fade" id="staticBackdropAdr" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropAdr" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropAdr">New Shipping Address</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('address.store') }}" id="insAdrForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="insAdrUsr" name="insAdrUsr" value="{{ Auth::user()->id }}">
                <div class="mb-3">
                    <label for="insAdrFname" class="form-label">First name:</label>
                    <input type="text" class="form-control" id="insAdrFname" name="insAdrFname" aria-describedby="insAdrFname">
                </div>
                <div class="mb-3">
                    <label for="insAdrLname" class="form-label">Last name:</label>
                    <input type="text" class="form-control" id="insAdrLname" name="insAdrLname" aria-describedby="insAdrLname">
                </div>
                <div class="mb-3">
                    <label for="insAdrMo" class="form-label">Mobile number:</label>
                    <input type="tel" class="form-control" id="insAdrMo" name="insAdrMo" aria-describedby="insAdrMo">
                </div>
                <div class="mb-3">
                    <label for="insAdrStr" class="form-label">Street address:</label>
                    <input type="text" class="form-control" id="insAdrStr" name="insAdrStr">
                </div>
                <div class="mb-3">
                    <select class="form-select" id="insAdrRgn" aria-label="Select region dropdown">
                        <option selected>Select region:</option>
                        <option value="NCR">National Capital Region</option>
                        <option value="CAR">Cordillera Region</option>
                        <option value="R01">Region I</option>
                        <option value="R02">Region II</option>
                        <option value="R03">Region III</option>
                        <option value="RSTM">Region IV-A</option>
                        <option value="RSTR">MIMAROPA</option>
                        <option value="R05">Region V</option>
                        <option value="R06">Region VI</option>
                        <option value="R07">Region VII</option>
                        <option value="R08">Region VIII</option>
                        <option value="R09">Region IX</option>
                        <option value="R10">Region X</option>
                        <option value="R11">Region XI</option>
                        <option value="R12">Region XII</option>
                        <option value="R13">Region XIII</option>
                        <option value="BSR">BARMM</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="insAdrCity" class="form-label">City:</label>
                    <input type="text" class="form-control" id="insAdrCity" name="insAdrCity">
                </div>
                <div class="mb-3">
                    <label for="insAdrZip" class="form-label">Zip code:</label>
                    <input type="text" class="form-control" id="insAdrZip" name="insAdrZip">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="staticUpd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticUpd" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticUpd">Edit Shipping Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('address.update') }}" id="updAdr" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="updAdrUsr" name="updAdrUsr" value="{{ Auth::user()->id }}">
                <input type="hidden" id="updRef" name="updRef">
                <div class="mb-3">
                    <label for="updAdrFname" class="form-label">First name:</label>
                    <input type="text" class="form-control" id="updAdrFname" name="updAdrFname" aria-describedby="updAdrFname">
                </div>
                <div class="mb-3">
                    <label for="updAdrLname" class="form-label">Last name:</label>
                    <input type="text" class="form-control" id="updAdrLname" name="updAdrLname" aria-describedby="updAdrLname">
                </div>
                <div class="mb-3">
                    <label for="updAdrMo" class="form-label">Mobile number:</label>
                    <input type="tel" class="form-control" id="updAdrMo" name="updAdrMo" aria-describedby="updAdrMo">
                </div>
                <div class="mb-3">
                    <label for="updAdrStr" class="form-label">Street address:</label>
                    <input type="text" class="form-control" id="updAdrStr" name="updAdrStr">
                </div>
                <div class="mb-3">
                    <select class="form-select" id="updAdrRgn" aria-label="Select region dropdown">
                        <option selected>Select region:</option>
                        <option value="NCR">National Capital Region</option>
                        <option value="CAR">Cordillera Region</option>
                        <option value="R01">Region I</option>
                        <option value="R02">Region II</option>
                        <option value="R03">Region III</option>
                        <option value="RSTM">Region IV-A</option>
                        <option value="RSTR">MIMAROPA</option>
                        <option value="R05">Region V</option>
                        <option value="R06">Region VI</option>
                        <option value="R07">Region VII</option>
                        <option value="R08">Region VIII</option>
                        <option value="R09">Region IX</option>
                        <option value="R10">Region X</option>
                        <option value="R11">Region XI</option>
                        <option value="R12">Region XII</option>
                        <option value="R13">Region XIII</option>
                        <option value="BSR">BARMM</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="updAdrCity" class="form-label">City:</label>
                    <input type="text" class="form-control" id="updAdrCity" name="updAdrCity">
                </div>
                <div class="mb-3">
                    <label for="updAdrZip" class="form-label">Zip code:</label>
                    <input type="text" class="form-control" id="updAdrZip" name="updAdrZip">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="staticDel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticDel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticDel">Delete shipping address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('address.destroy') }}" id="desAdr" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="desWarn"></div>
            <input type="hidden" id="desAdrUsr" name="desAdrUsr" value="{{ Auth::user()->id }}">
            <input type="hidden" id="desRef" name="desRef">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>

    window.addEventListener('load', stgLoad);

    function stgLoad()
    {
        const insAdrForm = document.getElementById('insAdrForm');
        const selNum = document.getElementById('selNum');

        if (insAdrForm) {
            insAdrForm.addEventListener('submit', storeAdr);
        }

        if (selNum) {
            selNum.addEventListener('change', changeRec);
        }

        getCust(1, 5);
    }

    function getCust(minRec, maxRec)
    {
        axios.get('/address/all')

        .then(response => {
            const custGet = response.data;

            console.log('cust: ', custGet);

            genBtn(custGet, minRec, maxRec);
            chunkRec(custGet, minRec, maxRec);
        })

        .catch(error => {
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

        if (list.length > 1) {
            ppNum = Math.ceil(list.length / len);

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
        console.log('list: ', list);
        let chunkGet = null;
        const dataTbl = document.getElementById('dataTbl');
        dataTbl.innerHTML = '';
        let ctr = ((chunkLen * currPage) - chunkLen) + 1;

        if (list.length > chunkLen || list.length < chunkLen) {
            chunkGet = list.slice((chunkLen * currPage) - chunkLen, (chunkLen * currPage));
        } else if (list.length == chunkLen) {
            chunkGet = list.slice((chunkLen * currPage) - chunkLen);
        }

        for (let i = 0; i < chunkGet.length; i++) {
            const tblRow = document.createElement('tr');
            tblRow.id = 'tblRow' + (i + 1);
            const tblHdr = document.createElement('th');
            tblHdr.scope = 'row';
            const tblFname = document.createElement('td');
            const tblLname = document.createElement('td');
            const tblMobile = document.createElement('td');
            const tblAdr = document.createElement('td');
            const tblRgn = document.createElement('td');
            const tblCity = document.createElement('td');
            const tblZip = document.createElement('td');
            const tblAct = document.createElement('td');
            const tblActUpd = document.createElement('button');
            const tblActDel = document.createElement('button');

            tblHdr.innerHTML = ctr++;

            console.log('fname: ', chunkGet[i].shpg_first_name);

            tblFname.innerHTML = chunkGet[i].shpg_first_name;
            tblLname.innerHTML = chunkGet[i].shpg_last_name;
            tblMobile.innerHTML = chunkGet[i].shpg_mobile_number;
            tblAdr.innerHTML = chunkGet[i].shpg_address;
            tblRgn.innerHTML = chunkGet[i].shpg_region;
            tblCity.innerHTML = chunkGet[i].shpg_city;
            tblZip.innerHTML = chunkGet[i].shpg_zip;

            tblActUpd.classList.add('btn');
            tblActUpd.dataset.bsToggle = 'modal';
            tblActUpd.dataset.bsTarget = '#staticUpd';
            tblActUpd.innerHTML = 'Update';
            tblActUpd.dataset.row = tblRow.id;
            tblActUpd.dataset.fname = chunkGet[i].shpg_first_name;
            tblActUpd.dataset.lname = chunkGet[i].shpg_last_name;
            tblActUpd.dataset.mobile = chunkGet[i].shpg_mobile_number;
            tblActUpd.dataset.adr = chunkGet[i].shpg_address;
            tblActUpd.dataset.rgn = chunkGet[i].shpg_region;
            tblActUpd.dataset.city = chunkGet[i].shpg_city;
            tblActUpd.dataset.zip = chunkGet[i].shpg_zip;
            tblActUpd.dataset.id = chunkGet[i].id;
            tblActDel.classList.add('btn');
            tblActDel.dataset.bsToggle = 'modal';
            tblActDel.dataset.bsTarget = '#staticDel';
            tblActDel.innerHTML = 'Delete';
            tblActDel.dataset.row = tblRow.id;
            tblActDel.dataset.id = chunkGet[i].id;

            tblActUpd.addEventListener('click', populateEl);
            tblActDel.addEventListener('click', populateEl)

            tblRow.appendChild(tblHdr);
            tblRow.appendChild(tblFname);
            tblRow.appendChild(tblLname);
            tblRow.appendChild(tblMobile);
            tblRow.appendChild(tblAdr);
            tblRow.appendChild(tblRgn);
            tblRow.appendChild(tblCity);
            tblRow.appendChild(tblZip);
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
                getCust(1, i.value);
            }
        }
    }

    function populateEl(el)
    {
        console.log('el: ', el.target);

        if (el.target.dataset.bsTarget.includes('Upd')) {
            const updAdr = document.getElementById('updAdr');
            updAdr.addEventListener('submit', editAdr);
            const updSelRgn = document.getElementById('updAdrRgn').children;

            const updFname = el.target.dataset.fname;
            const updLname = el.target.dataset.lname;
            const updMobile = el.target.dataset.mobile;
            const updAdrStr = el.target.dataset.adr;
            const updRgn = el.target.dataset.rgn;
            const updCity = el.target.dataset.city;
            const updZip = el.target.dataset.zip;
            const updRef = el.target.dataset.id;

            for (let i = 0; i < updSelRgn.length; i++) {
                if (updSelRgn[i].value == updRgn) {
                    updSelRgn[i].selected = true;
                    break;
                }
            }

            updAdr.updAdrFname.value = updFname;
            updAdr.updAdrLname.value = updLname;
            updAdr.updAdrMo.value = updMobile;
            updAdr.updAdrStr.value = updAdrStr;
            updAdr.updAdrCity.value = updCity;
            updAdr.updAdrZip.value = updZip;
            updAdr.updRef.value = updRef;
        } else if (el.target.dataset.bsTarget.includes('Del')) {
            const desAdr = document.getElementById('desAdr');
            const desWarn = document.getElementById('desWarn');
            desWarn.innerHTML = '';
            const desRef = el.target.dataset.id;
            const desHdr = document.createElement('div');
            const desRow = el.target.dataset.row;

            desAdr.desRef.value = desRef;
            desAdr.dataset.row = desRow;

            desWarn.classList.add('alert', 'alert-warning');

            desHdr.innerHTML = 'Are you sure you want to delete this shipping address&#x3f; This action is irreversible.';

            desWarn.prepend(desHdr);
            desAdr.addEventListener('submit', dstrAdr);
        }
    }

    function storeAdr(adr)
    {
        adr.preventDefault();

        console.log('trig', this);

        const insAdrRgn = document.getElementById('insAdrRgn').children;

        const adrParam = new FormData();

        adrParam.append('usr', this.insAdrUsr.value);
        adrParam.append('fname', this.insAdrFname.value);
        adrParam.append('lname', this.insAdrLname.value);
        adrParam.append('mobile', this.insAdrMo.value);
        adrParam.append('adr', this.insAdrStr.value);

        for (let i of insAdrRgn) {
            if (i.selected) {
                adrParam.append('rgn', i.value);
            }
        }

        adrParam.append('city', this.insAdrCity.value);
        adrParam.append('zip', this.insAdrZip.value);

        axios.post(this.action, adrParam)

        .then(response => {
            console.log(response);
        })

        .catch(error => {
            console.log(error.response.data.errors);
        })
    }

    function editAdr(adr)
    {
        adr.preventDefault();

        console.log('edit: ', this);
        const updAdrRgn = document.getElementById('updAdrRgn').children;

        const updParam = new FormData();

        updParam.append('usr', this.updAdrUsr.value);
        updParam.append('fname', this.updAdrFname.value);
        updParam.append('lname', this.updAdrLname.value);
        updParam.append('mobile', this.updAdrMo.value);
        updParam.append('adr', this.updAdrStr.value);

        for (let i of updAdrRgn) {
            if (i.selected) {
                updParam.append('rgn', i.value);
            }
        }

        updParam.append('city', this.updAdrCity.value);
        updParam.append('zip', this.updAdrZip.value);
        updParam.append('ref', this.updRef.value);

        axios.post(this.action, updParam)

        .then(response => {
            console.log('response: ', response);
        })

        .catch(error => {
            console.log('err: ', error.response);
        })
    }

    function dstrAdr(adr)
    {
        adr.preventDefault();

        console.log('destr', this);

        const dstrParam = new FormData();

        dstrParam.append('usr', this.desAdrUsr.value);
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
