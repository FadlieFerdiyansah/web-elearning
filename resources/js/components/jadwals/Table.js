import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom';

function Table(props) {
    const [jadwals, setJadwals] = useState([])
    const [url, setUrl] = useState(props.endpoint)
    const [links, setLinks] = useState([])
    const [isModal, setIsModal] = useState(false)

    const getJadwals = async (e) => {
        try {

            let response = await axios.get(url);
            setJadwals(response.data.data);
            setLinks(response.data.meta.links);
        } catch (e) {
            console.log(e);
        }
    }

    const modalHandler = (e) => {
        e.preventDefault()
        setIsModal(true)
    }

    useEffect((e) => {
        getJadwals();

    }, [url])

    return (
        <div>
            <div className="card">
                <div className="card-header d-flex justify-content-between">
                    <h4>{props.title}</h4>
                    <a href={props.routeCreate} className="btn btn-sm btn-primary"><i data-feather="plus"></i>Tambah Jadwal</a>
                </div>
                <div className="card-body">
                    <div className="table-responsive">
                        <table className="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hari</th>
                                    <th>Kelas</th>
                                    <th>Dosen Pengajar</th>
                                    <th>Matakuliah</th>
                                    <th>Jam</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {
                                    jadwals.map((jadwal, id) => {
                                        return (
                                            <tr key={id}>
                                                <td>{id + 1}</td>
                                                <td>{jadwal.hari}</td>
                                                <td>{jadwal.kelas}</td>
                                                <td>{jadwal.dosen}</td>
                                                <td>{jadwal.matkul}</td>
                                                <td>{`${jadwal.jam_masuk} - ${jadwal.jam_keluar}`}</td>
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
                    </div>
                    <ul className="pagination">
                        {
                            links.map((link, i) => {
                                return (
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
            routeCreate={item.getAttribute('routeCreate')}
            title={item.getAttribute('title')}
        />, item);
}
