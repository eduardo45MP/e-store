// src/components/FinancialReports.js
import React, { useEffect, useState } from 'react';
import api from '../axiosConfig';

const FinancialReports = () => {
  const [reports, setReports] = useState([]);

  useEffect(() => {
    api.get('/reports/financial')
      .then(response => {
        setReports(response.data);
      })
      .catch(error => {
        console.error('Erro ao gerar relatórios:', error);
      });
  }, []);

  return (
    <div>
      <h1>Relatórios Financeiros</h1>
      <ul>
        {reports.map(report => (
          <li key={report.id}>
            {report.date} - Total: {report.total}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default FinancialReports;
