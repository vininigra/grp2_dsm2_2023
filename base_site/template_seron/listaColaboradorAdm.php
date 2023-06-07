<?php
    require_once('session.php');
    require_once('Classes/Administrador.php');

?>




<?php foreach ($evento->read($session_id) as $eventoItem) : ?>
                        <tr>
                            <td><?= $eventoItem->getId() ?></td>
                            <td><?= $eventoItem->getData() ?></td>
                            <td><?= $eventoItem->getHora() ?></td>
                            <td><?= $eventoItem->getLocal() ?></td>
                            <td><?= $eventoItem->getTipo_esporte() ?></td>
                            <td><?= $eventoItem->getFaixa_etaria() ?></td>
                            <td class="text-center">
                                <button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#editar<?= $eventoItem->getId() ?>">
                                    Editar
                                </button>
                                <a href="deleteEvento.php?id=<?= $eventoItem->getId() ?>" >
                                    <button class="btn btn-danger btn-sm" type="button">Excluir</button>
                                </a>

                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="editar<?= $eventoItem->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="updateEvento.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Data</label>
                                                    <input type="date" name="data" value="<?= $eventoItem->getData() ?>" class="form-control" required />
                                                </div>
                                                <div class="col-md-7">
                                                    <label>Hora</label>
                                                    <input type="time" name="hora" value="<?= $eventoItem->getHora() ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Local</label>
                                                    <input type="text" name="local" value="<?= $eventoItem->getLocal() ?>" class="form-control" required />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Esporte</label>
                                                    <input type="text" name="tipo_esporte" value="<?= $eventoItem->getTipo_esporte() ?>" class="form-control" required />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Idade</label>
                                                    <input type="number" name="faixa_etaria" value="<?= $eventoItem->getFaixa_etaria() ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <br>
                                                    <input type="hidden" name="id" value="<?= $eventoItem->getId() ?>" />
                                                    <button class="btn btn-primary" type="submit" name="editar">Editar</button>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>