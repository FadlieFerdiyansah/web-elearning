import axios from 'axios';
import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom';

function Table(props) {
    const [jadwals, setJadwals] = useState([])
    const [url, setUrl] = useState(props.endpoint)
    const [links, setLinks] = useState([])
    const [filter, setFilter] = useState('')

    const getJadwals = async (e) => {
        try {
            let response = await axios.get(url, {params: {filter: filter}});
            setJadwals(response.data.data);
            response.data.meta ? setLinks(response.data.meta.links) : setLinks([])
        } catch (e) {
            console.log(e);
        }
    }

    const deleteJadwal = (e) => {
        e.preventDefault()
        if (window.confirm('Apakah anda yakin ingin menghapus jadwal ini?')) {
            axios.delete(`${props.endpoint}/${e.target.value}`)
            .then(response => {
                getJadwals()
            }
            )
        }
    }

    // const handleFilter = (e) => {
    //     e.preventDefault()
    //     getJadwals()
    // }

    useEffect((e) => {
        getJadwals()
    }, [url, filter])

    return (
        <div>
            <div className="card">
                <div className="card-header d-flex justify-content-between">
                    <h4>{props.title}</h4>
                    <a href={props.routeCreate} className="btn btn-sm btn-success"><i className="fas fa-plus"></i> Tambah Jadwal</a>
                </div>
                <div className="card-body">
                    <div className="table-responsive">
                        <div className="form-group">
                            <input type="search" value={filter} onChange={e => setFilter(e.target.value)} className="form-control" placeholder='Cari jadwal kelas disini...' />
                        </div>
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
                                    jadwals.length ?
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
                                                    <a href={`/jadwals/${jadwal.id}/edit`} className="btn btn-icon icon-left btn-primary btn-sm mr-1"><i className="fas fa-edit"></i> Edit</a>
                                                    <button className="btn btn-icon icon-left btn-danger btn-sm" value={jadwal.id} onClick={deleteJadwal}><i className="fas fa-trash"></i> Delete</button>
                                                </td>
                                            </tr>
                                        )
                                    })
                                    :
                                    <tr>
                                        <td colSpan="7" className="text-center">Tidak ada data</td>
                                    </tr>
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
