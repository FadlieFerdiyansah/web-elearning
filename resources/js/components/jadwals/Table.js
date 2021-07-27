import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom';

function Table(props) {
    const [jadwals, setJadwals] = useState([])
    const [url, setUrl] = useState(props.endpoint)
    const [links, setLinks] = useState([])

    const getJadwals = async (e) => {
        try {
            let response = await axios.get(url);
            setJadwals(response.data.data);
            setLinks(response.data.meta.links);
        } catch (e) {
            console.log(e);
        }
    }

    useEffect((e) => {
        getJadwals();

    }, [ url ])

    return (
        <div>
            <div className="card">
                <div className="card-header">
                    <h4>{props.title}</h4>
                </div>
                <div className="card-body">
                    <table className="table table-hover table-responsive">
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
                            {
                                jadwals.map((jadwal, id) => {
                                    return (
                                        <tr key={id}>
                                            <td>{id + 1}</td>
                                            <td>{jadwal.kelas}</td>
                                            <td>{jadwal.dosen}</td>
                                            <td>{jadwal.matkul}</td>
                                            <td>{jadwal.jam_masuk}</td>
                                            <td>{jadwal.jam_keluar}</td>
                                            <td>
                                                <a href="#" className="btn btn-icon icon-left btn-primary btn-sm mr-1"><i className="fas fa-edit"></i> Edit</a>
                                                <a href="#" className="btn btn-icon icon-left btn-danger btn-sm"><i className="fas fa-times"></i> Delete</a>
                                            </td>
                                        </tr>
                                    )
                                })
                            }
                        </tbody>
                    </table>
                      <ul className="pagination">
                        {
                                links.map((link,i) => {
                                    return(
                                        <li className={`page-item ${link.active && 'active'}`} key={i}>
                                            <button onClick={(e) => setUrl(link.url)} className="page-link">{link.label}</button>
                                        </li>
                                    )
                                })
                            }
                      </ul>
                </div>
            </div>
        </div>
    )
}

export default Table;

if (document.getElementById('table')) {
    var item = document.getElementById('table');
    ReactDOM.render(
        <Table
            endpoint={item.getAttribute('endpoint')}
            title={item.getAttribute('title')}
        />, item);
}
