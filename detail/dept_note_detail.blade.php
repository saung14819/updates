<div class="modal-content">
    <div class="modal-header">
        <h3 class="modal-title" id="add_contact_formTitle">Add Department Note</h3>
        <button type="button" style="margin-top:-40px;" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group" >
            <div class="row" >
                <div class="col-xs-2 job-label text-left" >
                    <label>Prepress: </label>
                </div>
                <div class="col-xs-9">
                    <select name="department" class="form-control">
                        @foreach ($department as $depp)

                                        <option value='{{$depp->id}}' selected>{{$depp->description}}</option>


                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group" >
            <div class="row" >
                <div class="col-xs-2 job-label text-left">
                    <label>Note: </label>
                </div>
                <div class="col-xs-9">

                        @if(!empty($job_note))
                            @foreach($job_note as $jbn)

                                    <textarea class="form-control" name="note">{{$jbn->note}}</textarea>

                            @endforeach
                        @endif

                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" data-dismiss="modal" onclick='submit_update_dep_form()' id="submit" value="Update" class="btn btn-success">
        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
        <input type='hidden' name='job' value={{$products->job}} />
        <input type="hidden" name='dept' value='' id="dept"/>
        <input type="hidden" name="note" value="" id="note"/>
    </div>
</div>