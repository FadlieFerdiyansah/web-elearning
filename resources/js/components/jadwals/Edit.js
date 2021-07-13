import React from 'react'

function Edit() {
    return (
        <div>
            <div>
                <table className="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Kelas</th>
                        <th>Dosen Pengajar</th>
                        <th>Matakuliah</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {/* <td>
                            <a href="#" className="btn btn-icon icon-left btn-primary btn-sm"><i className="fas fa-edit" /> Edit</a>
                            <a href="#" className="btn btn-icon icon-left btn-danger btn-sm"><i className="fas fa-times" /> Delete</a>
                            </td> */}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    )
}

export default Edit

if(document.getElementById('edit-jadwal')){
    var item = document.getElementById('edit-jadwal');
    ReactDOM.render(
                <Edit 
                    endpoint={item.getAttribute('endpoint')} 
                    title={item.getAttribute('title')}
                    />, item);
}