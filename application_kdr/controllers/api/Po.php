<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Po extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Setting/Model_Setting', 'modelSetting');

    }
        public function get_data_cabang()
        {
            // $string = $this->input->post('query');
            $this->db->select('*');
            $this->db->from('master_cabang');
            // $this->db->like('nama_cabang', $string);
            $data =  $this->db->get()->result_array();

            $output = json_encode($data);
            echo $output;
        }

    public function receive()
    {
        $post = $this->input->post();

        $this->db->select('no_order_po');
        $this->db->from('master_receive_po');
        $this->db->where('no_order_po', $post['kode_perusahaan'] . '-' . $post['no_order_po']);
        $cek = $this->db->get()->num_rows();
        
        if($cek > 0)
        {
            echo 'ada';
        }else{
            $data = [
                'dari' => $post['kode_perusahaan'],
                'no_order_po' => $post['kode_perusahaan'] . '-' . $post['no_order_po'],
                'total_pembelian' => $post['total_pembelian'],
                'biaya_lainnya' => $post['biaya_lainnya'],
                'grand_total' => $post['grand_total'],
                'keterangan' => $post['keterangan'],
                'status' => 0,
                'tanggal_masuk' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('master_receive_po', $data);

            echo 'sukses';
        }
        
    }

    function ubah_status_receive()
    {
        $post = $this->input->post();
        $data = [
            'status' => $post['status']
        ];
        $this->db->where('no_order_po', $post['no_order_po']);
        $this->db->update('master_po', $data);

        echo "sukses";
    }

    function get_data_po()
    {
        $no_order_po = $this->input->post('no_order_po');
        $this->db->select('*');
        $this->db->from('master_po');
        $this->db->where('no_order_po', $no_order_po);
        $data_po = $this->db->get()->row_array();

        $this->db->select('detail_po.*, master_satuan_barang.nama_satuan');
        $this->db->from('detail_po');
        $this->db->join('master_barang', 'master_barang.kode_barang = detail_po.kode_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where('no_order_po', $no_order_po);
        $detail_po = $this->db->get()->result_array();

        $detail_perusahaan = $this->modelSetting->get_data_perusahaan();

        $data = [
            'no_order_po' => $data_po['no_order_po'],
            'tanggal_transaksi' => $data_po['tanggal_transaksi'],
            'cabang' => $data_po['cabang'],
            'total_pembelian' => $data_po['total_pembelian'],
            'biaya_lainnya' => $data_po['biaya_lainnya'],
            'grand_total' => $data_po['grand_total'],
            'keterangan' => $data_po['keterangan'],
            'status' => $data_po['status'],
            'detail_perusahaan' => $detail_perusahaan,
            'detail_po' => $detail_po
        ];

        $output = json_encode($data);
        echo $output;
    }
}
   